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
                            <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow"
                                 data-handle-color="#a1b2bd">

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