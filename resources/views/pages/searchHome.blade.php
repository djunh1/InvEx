@extends('layouts.app')

@section('title')
    <title>Search The Investing Exchange</title>
@stop

@section('sideBar')
    @include('sidebar.sidebarHome')
@stop

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content"
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="/home">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Search Stocks</span>
                </li>
            </ul>
        </div>

        <div class="search-page search-content-1">
            <div class="search-bar ">
                <div class="row">
                    <form role="form"  method="POST" action="{{ url('/stocks/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-large">
                                    <input type="text" class="form-control" placeholder="Search Stocks..."
                                           name ="stockSearch">
                                    <span class="input-group-btn">
                                        <button class="btn blue" type="submit">Search</button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-5">
                                <span class="search-desc clearfix"> Search through our database of over 5000 stocks listed on the
                                S&P 500, and the NASDAQ Index.  </span>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
    </div>

    <!-- SEARCH RESULT -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if ($message)
                    <span class="label label-danger">{{ $message }}</span>
                @endif
            </div>

            @if ($symbol)
            <div class="col-md-12 ">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>{{ $symbol }} </div>
                        <div class="actions">
                            <a href="/stocks/{{ $id }}" class="btn btn-default btn-sm">
                                <i class="fa fa-home"></i> Research {{ $symbol }} </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow"
                             data-handle-color="#a1b2bd">
                            <strong>{{ $name }}</strong>
                            <br/> {{ $about }}</div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
            @endif
     <!-- END SEARCH RESULT -->

    </div>
    <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
@endsection