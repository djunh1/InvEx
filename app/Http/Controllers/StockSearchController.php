<?php namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Symbol as Symbol;

use Illuminate\Http\Request;

class StockSearchController extends Controller {


	public function index()
	{
	    $symbol = '';
        return view('pages.searchHome',[
            'symbol' => $symbol,
        ]);
	}

	public function searchResults(Request $request)
	{
        $stockSearch = $request->stockSearch;
        $stockSearch = str_replace('-', '.', $stockSearch);
        $symbol = Symbol::where('ticker', [$stockSearch,])->firstOrFail();
        return view('pages.searchHome', [
            'symbol'=> $symbol->ticker,
        ]);
	}


}
