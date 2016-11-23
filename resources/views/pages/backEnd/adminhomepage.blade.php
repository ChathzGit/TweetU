{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the home page
--
--}}

@extends('pages.adminIndex')

@section('content')
    <div id="page-wrapper" class="m-b-20" ng-controller="usageStatisticsController">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-right">Tweet-U Admin</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-sm-12 col-xs-12">

                <div class="col-sm-12 m-b-20">
                    <h3><strong>Total Usage Statistics:</strong></h3>
                </div>


                <div class="col-sm-3 col-xs-6 m-b-5 text-center">

                    <div class="col-sm-12 selected-profile p-0">

                        <div class="col-sm-12 p-l-30 p-r-30">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/atopics.png') }}">
                        </div>
                        <div class="col-xs-12">
                            <hr class="p-0 m-0">
                        </div>
                        <div class="col-sm-12">
                            <h4><strong><% AllTweets %></strong></h4>
                            <h5> Tweet Analysis</h5>
                        </div>
                    </div>

                </div>

                <div class="col-sm-3 col-xs-6 m-b-5 text-center">

                    <div class="col-sm-12 selected-profile p-0">

                        <div class="col-sm-12 p-l-30 p-r-30">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/aaccounts.png') }}">
                        </div>
                        <div class="col-xs-12">
                            <hr class="p-0 m-0">
                        </div>
                        <div class="col-sm-12">
                            <h4><strong><% AllAccounts %></strong></h4>
                            <h5> Account Analysis</h5>
                        </div>
                    </div>

                </div>


                <div class="col-sm-3 col-xs-6 m-b-5 text-center">

                    <div class="col-sm-12 selected-profile p-0">

                        <div class="col-sm-12 p-l-30 p-r-30">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/ctopics.png') }}">
                        </div>
                        <div class="col-xs-12">
                            <hr class="p-0 m-0">
                        </div>
                        <div class="col-sm-12">
                            <h4><strong><% AllTopicComps %></strong></h4>
                            <h5> Topic Comparisons</h5>
                        </div>
                    </div>

                </div>


                <div class="col-sm-3 col-xs-6 m-b-5 text-center">

                    <div class="col-sm-12 selected-profile p-0">

                        <div class="col-sm-12 p-l-30 p-r-30">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/caccounts.png') }}">
                        </div>
                        <div class="col-xs-12">
                            <hr class="p-0 m-0">
                        </div>
                        <div class="col-sm-12">
                            <h4><strong><% AllAccountComps %></strong></h4>
                            <h5> Account Comparisons</h5>
                        </div>
                    </div>

                </div>


            </div>
        </div>

        <div class="row">
            <hr>
        </div>


        <div class="row" hidden>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><% AllTweets %></div>
                                <div>New Visits!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">12</div>
                                <div>New Searches!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">124</div>
                                <div>New Comparisons!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">13</div>
                                <div>New Accounts!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="col-sm-12">
                    <h3><strong>Site Usage This Month:</strong></h3>
                </div>

                <div class="col-sm-12">
                    <div class="hidden-xs" id="usageChart" style="height: 250px;"></div>
                    <div class="visible-xs" id="usageChartMobile" style="height: 250px;"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <hr>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="col-sm-12 m-b-20">
                    <h3><strong>Percentage Usage This Month:</strong></h3>
                </div>
                <!-- /.panel-heading -->

                <div class="col-sm-12">

                    <div class="col-sm-3 m-b-5">

                        <div class="col-sm-12 selected-profile">
                            <h4><strong>Tweet Analysis</strong></h4>
                                <span ng-class="{'c-green': TweetPercentage >= 100, 'c-red': TweetPercentage < 100 }"><% TweetPercentage %>
                                    %</span>
                            <hr>
                        <span ng-show="TweetPercentage >= 100">A <% TweetPercentage %>
                            % increase in Tweet analytic usage</span>
                            <span ng-show="TweetPercentage == 0">Percentage not available</span>
                            <span ng-show="TweetPercentage < 100 && TweetPercentage != 0">A <% TweetPercentage %>% decrease in tweet analytic usage</span>
                        </div>
                    </div>

                    <div class="col-sm-3 m-b-5">
                        <div class="col-sm-12 selected-profile">
                            <h4>Account Analysis</h4>
                                <span ng-class="{'c-green': AccountPercentage >= 100, 'c-red': AccountPercentage < 100 }"><% AccountPercentage %>
                                    %</span>
                            <hr>
                <span ng-show="AccountPercentage >= 100">A <% AccountPercentage %>
                    % increase in Tweet analytic usage</span>
                            <span ng-show="AccountPercentage == 0">Percentage not available</span>
                                <span ng-show="AccountPercentage < 100 && AccountPercentage != 0">A <% AccountPercentage %>
                                    % decrease in account analytic usage</span>
                        </div>
                    </div>

                    <div class="col-sm-3 m-b-5">
                        <div class="col-sm-12 selected-profile">
                            <h4>Topic Comparisons</h4>
                                <span ng-class="{'c-green': TopicComparisonPercentage >= 100, 'c-red': TopicComparisonPercentage < 100 }"><% TopicComparisonPercentage %>
                                    %</span>
                            <hr>
                            <span ng-show="TopicComparisonPercentage >= 100">A <% TopicComparisonPercentage %>% increase in Tweet analytic usage</span>
                            <span ng-show="TopicComparisonPercentage == 0">Percentage not available</span>
                                <span ng-show="TopicComparisonPercentage < 100 && TopicComparisonPercentage != 0">A <% TopicComparisonPercentage %>
                                    % decrease in comparisons done</span>
                        </div>
                    </div>

                    <div class="col-sm-3 m-b-5">
                        <div class="col-sm-12 selected-profile">
                            <h4>Account Comparisons</h4>
                                <span ng-class="{'c-green': AccountComparisonPercentage >= 100, 'c-red': AccountComparisonPercentage < 100 }"><% AccountComparisonPercentage %>
                                    %</span>
                            <hr>
                            <span ng-show="AccountComparisonPercentage >= 100">A <% AccountComparisonPercentage %>% increase in Tweet analytic usage</span>
                            <span ng-show="AccountComparisonPercentage == 0">Percentage not available</span>
                                <span ng-show="AccountComparisonPercentage < 100 && AccountComparisonPercentage != 0">A <% AccountComparisonPercentage %>
                                    % decrease in comparisons done</span>
                        </div>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
        </div>

        <div class="row" style="height: 200px;">

        </div>
    </div>


@stop