@extends('layouts.app')

@section('title')
    <title>Search The Investing Exchange</title>
@stop

@section('sideBar')
    @include('sidebar.sidebarSearch')
@stop

@section('content')

    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content"
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url('/stocks') }}">Stocks</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{ $companyName }}</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Overview</span>
                </li>
            </ul>
        </div>


        <!-- SEARCH RESULT -->
        <div class="row">

                <div class="col-md-12 ">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>{{ $name }} </div>

                        </div>
                        <div class="portlet-body">
                            <div class="invoice">
                                <div class="row invoice-logo">
                                    <div class="col-xs-11">
                                        <div class="m-heading-1 border-green m-bordered">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h3>{{ $companyName }}</h3>
                                                    <span class="stockInfo">Traded on the:</span>
                                                    <span class="stockInfo">{{$exchange}}</span><br>
                                                    <br> <span class="basic-info-price">${{$lastPrice}}</span>
                                                    <br>
                                                    <span class="basic-info-pcnt"> {{$priceChange}}$ </span>
                                                    <span class="basic-info-pcnt">({{$pcntChng}}%)</span><br>

                                                </div>
                                                <div class="col-md-4">
                                                            <table class="table table-hover table-stats">
                                                                <thead>
                                                                    <th>Share Info.</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>52-wk Range</td>
                                                                        <td class="table-text-right">${{$yrLow}} - ${{$yrHigh}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Vol/Avg.</td>
                                                                        <td class="table-text-right"> {{$volume}}M / {{$volAvg}}M</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mkt Cap:</td>
                                                                        <td class="table-text-right">{{$mktCap}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Shares Outst.</td>
                                                                        <td class="table-text-right">{{$sharesOutstg}} Mil.</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Enterprise Value</td>
                                                                        <td class="table-text-right">{{$ev}} Bil.</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>P/B Value</td>
                                                                        <td class="table-text-right">{{$pb}}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Net-Net</td>
                                                                        <td class="table-text-right">${{$netNet}} /share</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>NCAV</td>
                                                                        <td class="table-text-right">${{$ncav}} /share</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>FCF Yield</td>
                                                                        <td class="table-text-right">${{$fcf}} /share</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                </div>
                                                <div class="col-md-4">
                                                    <table class="table table-hover table-stats">
                                                        <thead>
                                                        <th>Earnings</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>EBITDA</td>
                                                            <td class="table-text-right">{{$EBITDA}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>EPS</td>
                                                            <td class="table-text-right"> ${{$eps}}/share</td>
                                                        </tr>
                                                        <tr>
                                                            <td>P/E</td>
                                                            <td class="table-text-right">{{$pe}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table><hr class="basic-stats-hr">

                                                    <table class="table table-hover table-stats">
                                                        <thead>
                                                        <th>Value Ratios</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>EV/Rev.</td>
                                                            <td class="table-text-right">{{$evRev}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>EV/EBIT</td>
                                                            <td class="table-text-right">{{$evEbit}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>EV/EBITDA</td>
                                                            <td class="table-text-right"> {{$evEbitda}}</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class=" icon-layers font-green"></i>
                                                        <span class="caption-subject font-green bold uppercase">{{ $companyName }} </span>
                                                    </div>

                                                </div>
                                                <div class="portlet-body">
                                                    <div id="stockChart" style="height:500px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
                                        <script type="text/javascript">
                                            // configure for module loader
                                            var dataDate = [<?php echo json_encode($dateData);?>];
                                            var dataPrice = [<?php echo json_encode($priceData);?>];
                                            require.config({
                                                paths: {
                                                    echarts: 'http://echarts.baidu.com/build/dist'
                                                }
                                            });
                                            require(
                                                    [
                                                        'echarts',
                                                        'echarts/chart/k' // require the specific chart type
                                                    ],
                                                    function (ec) {
                                                        // Initialize after dom ready
                                                        var myChart = ec.init(document.getElementById('stockChart'));

                                                        option = {
                                                            tooltip : {
                                                                trigger: 'axis',
                                                                formatter: function (params) {
                                                                    var res = params[0].seriesName + ' ' + params[0].name;
                                                                    res += '<br/>  Open : ' + params[0].value[0] + '  High : ' + params[0].value[3];
                                                                    res += '<br/>  Close : ' + params[0].value[1] + '  Low : ' + params[0].value[2];
                                                                    return res;
                                                                }
                                                            },
                                                            legend: {
                                                                data:['Price Chart']
                                                            },
                                                            toolbox: {
                                                                show : true,
                                                                feature : {
                                                                    mark : {show: true},
                                                                    dataZoom : {show: true},
                                                                    dataView : {show: true, readOnly: false},
                                                                    restore : {show: true},
                                                                    saveAsImage : {show: true}
                                                                }
                                                            },
                                                            dataZoom : {
                                                                show : true,
                                                                realtime: true,
                                                                start : 0,
                                                                end : 50
                                                            },
                                                            xAxis : [
                                                                {
                                                                    type : 'category',
                                                                    boundaryGap : true,
                                                                    axisTick: {onGap:false},
                                                                    splitLine: {show:false},
                                                                    data : dataDate,
                                                                }
                                                            ],
                                                            yAxis : [
                                                                {
                                                                    type : 'value',
                                                                    scale:true,
                                                                    boundaryGap: [0.01, 0.01]
                                                                }
                                                            ],
                                                            series : [
                                                                {
                                                                    name:'Stock Chart',
                                                                    type:'k',
                                                                    barMaxWidth: 20,
                                                                    itemStyle: {
                                                                        normal: {
                                                                            color: 'red',           // 阳线填充颜色
                                                                            color0: 'lightgreen',   // 阴线填充颜色
                                                                            lineStyle: {
                                                                                width: 2,
                                                                                color: 'orange',    // 阳线边框颜色
                                                                                color0: 'green'     // 阴线边框颜色
                                                                            }
                                                                        },
                                                                        emphasis: {
                                                                            color: 'black',         // 阳线填充颜色
                                                                            color0: 'white'         // 阴线填充颜色
                                                                        }
                                                                    },
                                                                    data: dataPrice,

                                                                }
                                                            ]
                                                        };
                                                        // Load data into the ECharts instance
                                                        myChart.setOption(option);
                                                    }
                                            );
                                        </script>
                                    </div>
                            </div>
                    </div>
                    <!-- END Portlet PORTLET-->
                </div>

        <!-- END SEARCH RESULT -->

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
@stop