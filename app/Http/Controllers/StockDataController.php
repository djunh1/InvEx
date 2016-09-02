<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use App\Symbol as Symbol;
use PhpParser\Node\Expr\Array_;
use Scheb\YahooFinanceApi;

class StockDataController extends Controller {

    function __construct()
    {
        // Initiate hash in constructor to access the database by name vice number //
        $this->ticker = 'ticker';
        $this->revenue = 1;
		$this->netEarnings = 25;
		$this->eps = 49;
		$this->CF_operations = 98;
		$this->CF_CapEx = 99;
		$this->shareOutstanding = 91;
		$this->EBIT = 17;
		$this->DA = 93;
		$this->LTdebt = 73;
		$this->cashAndEquiv = 50;
		$this->acctRecievables = 55;
		$this->acctInvendory = 56;
		$this->currentAssets = 59;
		$this->totalLiabilities = 80;
        $this->shEquity = 88;

    }

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
        $pb = $this->stockDataFull($symbol->ticker, $client, "PriceBook");
        $pe = $this-> getPE($lastPrice, $eps);

        /* Fetch data from mysql server datastore*/
        $sharesOutstanding = $this->getStatementData($symbol->id,$this->shareOutstanding);
        $enterpriseValue = $this->getEnterpriseValue($symbol->id, $mktCap);
        $ncav = $this->getNCAV($symbol->id);
        $netNet = $this->getNetNet($symbol->id);
        $fcfPerShare = $this->getFcfYield($symbol->id);

        //Value Ratios

        $evRev = $this->getEvRev($symbol->id, $enterpriseValue);
        $evEbit = $this->getEvEbit($symbol->id, $enterpriseValue);
        $evEbitda = $this->getEvEbitda($EBITDA, $enterpriseValue);

        //Chart data - Dates and O,H,L,C

        $rawPriceData= $this->getStockPriceData($symbol->ticker, $client);
        $dates = $this->getDatesArray($rawPriceData);
        $prices = $this->getPriceArray($rawPriceData);


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
            'sharesOutstg' => $sharesOutstanding,
            'pb' => $pb,
            'ev' => $enterpriseValue,
            'ncav' => $ncav,
            'netNet' => $netNet,
            'fcf' => $fcfPerShare,
            'pe'=> $pe,
            'evRev' => $evRev,
            'evEbit' => $evEbit,
            'evEbitda' =>$evEbitda,
            'dateData'=> json_encode($dates),
            'priceData'=> json_encode($prices),
        ]);
    }

    private function stockData($stockTicker, $client, $searchTerm)
    {
        // Add a try/catch here to catch Yahoo API problems
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

    private function getStatementData($id, $statementId){
        //Returns LATEST data from ANNUAL Reports Only
        $data =DB::table('statementData_test')->where('symbol_id',$id)->where('statementRow_Id',$statementId)->
        where('type','annual')->get();
        $result = end($data)->amount;
        if (gettype($result)=='string'){
            $result = (int)$result;
        }
        return $result;
    }

    private function getEnterpriseValue($id, $mktCap)
    {
        $debt = $this->getStatementData($id,$this->LTdebt);
        $cash = $this->getStatementData($id,$this->cashAndEquiv);
        $marketCap = $this->mktCapCleaner($mktCap);

        $cd = $debt - $cash;
        $ev = round(($marketCap + $cd)/1000, 2);
        return $ev;

    }

    private function getNCAV($id)
    {
        $currentAssets = $this->getStatementData($id,$this->currentAssets);
        $totsLiabilities= $this->getStatementData($id,$this->totalLiabilities);
        $sharesOutstanding = $this->getStatementData($id,$this->shareOutstanding);

        $ncav = round(($currentAssets - $totsLiabilities)*(1/$sharesOutstanding),2);
        return $ncav;

    }

    private function getNetNet($id)
    {
        $cashEquiv = $this->getStatementData($id,$this->cashAndEquiv);
        $accRec = $this->getStatementData($id,$this->acctRecievables);
        $accInv = $this->getStatementData($id,$this->acctInvendory);
        $totsLiab = $this->getStatementData($id,$this->totalLiabilities);
        $sharesOutstg = $this->getStatementData($id,$this->shareOutstanding);

        $netNet = ($cashEquiv+ 0.75*$accRec+ 0.50*$accInv- $totsLiab)*(1.0/$sharesOutstg);
        //dd($cashEquiv, $accRec, $accInv, $totsLiab, $sharesOutstg);

        return round($netNet,2);
    }

    private function getFcfYield($id)
    {
        $cfOps= $this->getStatementData($id,$this->CF_operations);
        $capEx = $this->getStatementData($id,$this->CF_CapEx);
        $sharesOutstg = $this->getStatementData($id,$this->shareOutstanding);
        $fcf = ($cfOps + $capEx)*(1.0/$sharesOutstg);

        return round($fcf,2);
    }

    private function getPE($lastPrice, $eps)
    {
        $pe = round($lastPrice/$eps,1);
        if($pe<0){
            $pe=0;
            return $pe;
        } else{
            return $pe;
        }
    }

    private function getEvRev($id, $ev)
    {
        // Enterprise value is in Billions, this converts to millions since Revenue is reported in millions USD
        $rev= $this->getStatementData($id,$this->revenue);
        $evRev = 1000*($ev/$rev);
        return round($evRev,2);
    }

    private function getEvEbit($id, $ev)
    {
        //Need to convert
        $ebit= $this->getStatementData($id,$this->EBIT);
        $evEbit = 1000*$ev/$ebit;
        return round($evEbit,2);
    }

    private function getEvEbitda($ebitda, $ev)
    {
        return round($ev/$ebitda,2);
    }

    private function mktCapCleaner($value)
    {
        $pattern = "/[B]/";
        if ($tickerTest = preg_match($pattern, $value)){
            $mktCap = (int)rtrim($value, "B")*1000;
        }else {
            $mktCap = (int)rtrim($value, "M")*1;
        }
        return $mktCap;
    }

    private function getStockPriceData($stockTicker, $client)
    {
        $startDate = (new \DateTime())->modify('-364 day');
        $now= (new \DateTime())->modify('-1 day');

        $data = $client->getHistoricalData($stockTicker, $startDate, $now);
        return $data;
    }

    private function getDatesArray($data)
    {
        $dateArray = array();

        for ($i=0; $i<count($data['query']['results']['quote']); $i++){
            $dateArray[$i] = $data['query']['results']['quote'][$i]['Date'];
        }
        return $dateArray;
    }

    private function getPriceArray($data)
    {
        $priceArray = array();
        for ($i=0; $i<count($data['query']['results']['quote']); $i++){
            $priceArray[$i][0] = round((float)$data['query']['results']['quote'][$i]['Open'],2);
            $priceArray[$i][1] = round((float)$data['query']['results']['quote'][$i]['High'],2);
            $priceArray[$i][2] = round((float)$data['query']['results']['quote'][$i]['Low'],2);
            $priceArray[$i][3] = round((float)$data['query']['results']['quote'][$i]['Close'],2);
        }
        return $priceArray;
    }

}
