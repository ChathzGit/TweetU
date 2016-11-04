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




                <div class="col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Site Usage This Month
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
                            <div class="hidden-xs" id="usageChart" style="height: 250px;"></div>
                            <div class="visible-xs" id="usageChartMobile" style="height: 250px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>





                <div class="col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Site Usage This Month
                            {{--<div class="pull-right">--}}
                            {{--<div class="btn-group">--}}
                            {{--<button type="button" class="btn btn-default btn-xs dropdown-toggle"--}}
                            {{--data-toggle="dropdown">--}}
                            {{--Actions--}}
                            {{--<span class="caret"></span>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu pull-right" role="menu">--}}
                            {{--<li><a href="#">Action</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Another action</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Something else here</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li><a href="#">Separated link</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="col-sm-12">

                                <div class="col-sm-4">
                                    <h4>Tweet Analysis</h4>
                                    <span ng-class="{'c-green': TweetPercentage >= 100, 'c-red': TweetPercentage < 100 }"><% TweetPercentage %> %</span>
                                    <hr>
                                    <span ng-show="TweetPercentage >= 100">A <% TweetPercentage %>% increase in Tweet analytic usage</span>
                                    <span ng-show="TweetPercentage == 0">Percentage not available</span>
                                    <span ng-show="TweetPercentage < 100 && TweetPercentage != 0">A <% TweetPercentage %>% decrease in Tweet analytic usage</span>
                                </div>

                                <div class="col-sm-4">
                                    <h4>Account Analysis</h4>
                                    <span ng-class="{'c-green': AccountPercentage >= 100, 'c-red': AccountPercentage < 100 }"><% AccountPercentage %> %</span>
                                    <hr>
                                    <span ng-show="AccountPercentage >= 100">A <% AccountPercentage %>% increase in Tweet analytic usage</span>
                                    <span ng-show="AccountPercentage == 0">Percentage not available</span>
                                    <span ng-show="AccountPercentage < 100 && AccountPercentage != 0">A <% AccountPercentage %>% decrease in Tweet analytic usage</span>
                                </div>

                                <div class="col-sm-4">
                                    <h4>Comparisons Done</h4>
                                    <span ng-class="{'c-green': ComparisonPercentage >= 100, 'c-red': ComparisonPercentage < 100 }"><% ComparisonPercentage %> %</span>
                                    <hr>
                                    <span ng-show="ComparisonPercentage >= 100">A <% ComparisonPercentage %>% increase in Tweet analytic usage</span>
                                    <span ng-show="ComparisonPercentage == 0">Percentage not available</span>
                                    <span ng-show="ComparisonPercentage < 100 && ComparisonPercentage != 0">A <% ComparisonPercentage %>% decrease in Tweet analytic usage</span>
                                </div>

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>







            </div>
            <!-- /.col-lg-12 -->
        </div>


    </div>
@endsection