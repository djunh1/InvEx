<?php namespace App\Http\Controllers;


use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Symbol as Symbol;
use Goutte\Client;

use Illuminate\Http\Request;

class StockSearchController extends Controller {


	public function index()
	{
	    $symbol = $message ='';
        return view('pages.searchHome',[
            'symbol' => $symbol,
            'message' => '',
        ]);
	}


	public function searchResults(Request $request)
    {
        $message = '';
        $stockSearch = $request->stockSearch;
        $stockSearch = str_replace('-', '.', $stockSearch);
        try{
            $symbol = Symbol::where('ticker', [$stockSearch,])->firstOrFail();
        } catch(ModelNotFoundException $ex)
        {
            $symbol = $name = $about = '';
            $message = 'We were unable to find " '.$stockSearch.' ".  Please search again.';
            return view('pages.searchHome', [
                'symbol' => $symbol,
                'name' => $name,
                'message' => $message,
            ]);
        }

        $stockInfo = $this->scrapeStockInfo($symbol->ticker);
        return view('pages.searchHome', [
            'symbol' => $symbol->ticker,
            'name' => $symbol->name,
            'message' => '',
            'about' => $stockInfo,
        ]);

	}

    private function scrapeStockInfo($stockTicker)
    {
        $client = new Client();
        $baseUrl = 'https://www.google.com/finance?q=';
        $urlEndpoint = '&ei=-6qzV9HYO83BeJnlpaAC';
        $domSelector = '//*[@id="summary"]/div[2]/div';
        $crawler = $client->request('GET', $baseUrl.$stockTicker.$urlEndpoint);
        $results = $crawler->filterXPath($domSelector);
        $filterText = '\n
                        \n
                        \n
                        More from Reuters »\n
                        \n';
        $fresults = rtrim($results->text(), $filterText);
        return $fresults;
    }

}
