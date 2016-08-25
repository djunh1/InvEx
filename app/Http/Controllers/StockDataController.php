<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Symbol as Symbol;
use Scheb\YahooFinanceApi;

class StockDataController extends Controller {

    public function basicResults($id)
    {
        $client = new YahooFinanceApi\ApiClient();
        $symbol = Symbol::find($id);
        /* Basic Data Fetch */
        $lastPrice = $this->stockData($symbol->ticker, $client, "LastTradePriceOnly");
        $priceChange = $this->stockData($symbol->ticker, $client, "Change");
        $pcntChng = $this->calcPercentChng($priceChange, $lastPrice);
        $volume = $this->stockData($symbol->ticker, $client, "Volume");

        /* Full Data Fetch */
        $volAvg = $this->stockDataFull($symbol->ticker, $client, "AverageDailyVolume");
        $eps = $this->stockDataFull($symbol->ticker, $client, "EarningsShare");
        $yrHigh = $this->stockDataFull($symbol->ticker, $client, "YearHigh");
        $yrLow = $this->stockDataFull($symbol->ticker, $client, "YearLow");
        $mktCap = $this->stockDataFull($symbol->ticker, $client, "MarketCapitalization");
        $EBITDA = $this->stockDataFull($symbol->ticker, $client, "EBITDA");
        $div = $this->stockDataFull($symbol->ticker, $client, "DividendYield");
        $stockExchange = $this->stockDataFull($symbol->ticker, $client, "StockExchange");

        return view('pages.searchResultBasic', [
            'id' => $symbol->id,
            'name' => $symbol->ticker,
            'companyName' => $symbol->name,
            'exchange'=> $stockExchange,
            'lastPrice' => round($lastPrice,2),
            'priceChange' => $priceChange,
            'pcntChng'=> $pcntChng,
            'volume' => $this->convertVolume($volume),
            'volAvg' => $this->convertVolume($volAvg),
            'eps' => $eps,
            'yrHigh' => $yrHigh,
            'yrLow' => $yrLow,
            'mktCap' => $mktCap,
            'div' => $div,
            'EBITDA' =>$EBITDA,
        ]);
    }

    private function stockData($stockTicker, $client, $searchTerm)
    {
        $data = $client->getQuotesList($stockTicker);
        return $data["query"]["results"]["quote"][$searchTerm];
    }

    private function stockDataFull($stockTicker, $client, $searchTerm)
    {
        $data = $client->getQuotes($stockTicker);
        //dd($data);
        return $data["query"]["results"]["quote"][$searchTerm];
    }

    private function calcPercentChng($val1, $val2)
    {
        $pcnt = round(100*($val1/$val2),2);
        return $pcnt;
    }

    private function convertVolume($x)
    {
        $vol= (int)$x/1000000;
        $volume = round($vol,2);
        return $volume;
    }



}
