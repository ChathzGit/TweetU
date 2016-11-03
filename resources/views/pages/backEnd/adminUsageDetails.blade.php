{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the usage details page
--
--}}

@extends('pages.adminIndex')

@section('content')
    <div id="page-wrapper" ng-controller="usageStatisticsController">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Usage Statistics</h1>

                {{--<h2>Tweet Searches Done : <% searchLogCountTweets %></h2>--}}

                {{--<h2>Account Searches Done : <% searchLogCountAccounts  %></h2>--}}

                {{--<h2>Comparisons Done : <% searchLogCountComparisons %></h2>--}}


                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Site Usage
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                                            data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>

            </div>
            <!-- /.col-lg-12 -->
        </div>


    </div>
@endsection