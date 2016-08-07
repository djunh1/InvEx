@extends('layouts.app')

@section('title')
    <title>Search The Investing Exchange</title>
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
                    <a href="index.html">Home</a>
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
                    <form role="form" form method="POST" action="{{ url('/stocks/search') }}">
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
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </form>


                </div>
            </div>
    </div>

    <!-- SEARCH RESULT -->
        <div class="row">
            @if ($symbol)
            <div class="col-md-4 ">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>{{ $symbol }} </div>
                        <div class="actions">
                            <a href="javascript:;" class="btn btn-default btn-sm">
                                <i class="fa fa-pencil"></i> Edit </a>
                            <a href="javascript:;" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Add </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                            <strong>Scroll is hidden</strong>
                            <br/> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula,
                            eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus
                            sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis
                            mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </div>
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