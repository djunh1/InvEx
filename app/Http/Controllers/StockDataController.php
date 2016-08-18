<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Symbol as Symbol;

class StockDataController extends Controller {

    public function basicResults($id)
    {
        $symbol = Symbol::find($id);
        return view('pages.searchResultBasic', [
            'name' => $symbol->ticker,
            'companyName' => $symbol->name,
        ]);
    }
}
