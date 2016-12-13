{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is tweet comparison page
--
-- Modified by Chathra Seneviratne
--}}

@extends('pages.index')

@section('content')

    <style>
        blockquote.twitter-tweet {
            display: inline-block;
            font-family: "Helvetica Neue", Roboto, "Segoe UI", Calibri, sans-serif;
            font-size: 12px;
            font-weight: bold;
            line-height: 16px;
            border-color: #eee #ddd #bbb;
            border-radius: 5px;
            border-style: solid;
            border-width: 1px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
            margin: 10px 5px;
            padding: 0 16px 16px 16px;
            max-width: 468px;
        }

        blockquote.twitter-tweet p {
            font-size: 16px;
            font-weight: normal;
            line-height: 20px;
        }

        blockquote.twitter-tweet a {
            color: inherit;
            font-weight: normal;
            text-decoration: none;
            outline: 0 none;
        }

        blockquote.twitter-tweet a:hover,
        blockquote.twitter-tweet a:focus {
            text-decoration: underline;
        }
    </style>




    <div class="container-fluid" ng-controller="tweetComparisonCtrl">

        <div class="loading-gif-one"
             ng-if="loading"
                ></div>

        <div class="container">


            <!-- --------------------------------------------------------------------------------------------------------------- -->
            <div class="row m-t-20 well bg-opc-65">


                <div class="col-sm-1"></div>

                <div class="col-sm-10">


                    <div class="col-sm-11 col-xs-10 p-0">
                        <div class="col-sm-6 col-xs-12 m-b-5">
                            <input id="search" class="form-control" type="text" ng-model="search"
                                   placeholder="First Comparison Topic"
                                   ng-keyup="$event.keyCode == 13 && getInfo()">
                        </div>

                        <div class="col-sm-6 col-xs-12 m-b-5">
                            <input id="search" class="form-control" type="text" ng-model="search2"
                                   placeholder="First Comparison Topic"
                                   ng-keyup="$event.keyCode == 13 && getInfo()">
                        </div>
                    </div>

                    <div class="col-sm-1 col-xs-2">
                        <Button id="search-btn" class="btn btn-default" ng-click="getInfo()">
                            <i class="fa fa-search"></i>
                        </Button>
                    </div>

                    <div class="col-sm-12 m-t-20" ng-if="!isSearched">
                        <hr>
                        <p class="text-grey text-center">Analyze two topics simultaneously, and compare the public
                            perception of the
                            two.</p>
                    </div>


                </div>

                <div class="col-sm-1"></div>


            </div>


            <!-- --------------------------------------------------------------------------------------------------------------- -->


            <div class="row m-t-20 well bg-opc-65" ng-if="isCompared">


                <!-- Bar Chart comparing the two -->
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <h4>Positive Tweet Comparison:</h4>
                        <canvas id="bar" class="chart chart-bar" style="height:250px;"
                                chart-data="bardata2" chart-labels="barlabels2" chart-options="baroptions2"
                                chart-colors="barcolors2">
                        </canvas>
                    </div>
                    <div class="col-sm-6">
                        <h4>Negative Tweet Comparison:</h4>
                        <canvas id="bar2" class="chart chart-bar" style="height:250px;"
                                chart-data="bardata" chart-labels="barlabels" chart-options="baroptions"
                                chart-colors="barcolors">
                        </canvas>
                    </div>
                </div>
            </div>


            <!-- Pie charts describing each separately -->
            <div class="row m-t-20 well bg-opc-65" ng-if="isCompared">

                <div class="col-sm-12">
                    <div class="col-sm-6 col-xs-12">

                        <div class="col-sm-12">
                            <h4>First Topic</h4>
                        </div>

                        <div class="col-sm-12">
                            <label style="color:#3498DB; font-size: x-large">Bad</label>
                            <label id="negative" style="color:#3498DB; font-size: large"><%negative%>%</label>
                        </div>

                        <div class="col-sm-12">
                            <canvas id="pie" class="chart chart-pie" style="height:60px;"
                                    chart-data="data" chart-labels="labels" chart-options="options"
                                    chart-colors="colors">
                            </canvas>
                        </div>

                        <div class="col-sm-12">
                            <label style="color:#72C02C; font-size: x-large">Good</label>
                            <label id="positive" style="color:#72C02C; font-size: large"><%positive%>%</label>
                        </div>
                    </div>


                    <div class="col-xs-12 visible-xs">
                        <hr>
                    </div>


                    <div class="col-sm-6 col-xs-12">
                        <div class="col-sm-12">
                            <h4>Second Topic</h4>
                        </div>

                        <div class="col-sm-12">
                            <label style="color:#3498DB; font-size: x-large">Bad2</label>
                            <label id="negative2" style="color:#3498DB; font-size: large"><%negative2%>%</label>
                        </div>

                        <div class="col-sm-12">
                            <canvas id="pie2" class="chart chart-pie" style="height:60px;"
                                    chart-data="data2" chart-labels="labels2" chart-options="options2"
                                    chart-colors="colors2">
                            </canvas>
                        </div>

                        <div class="col-sm-12">
                            <label style="color:#72C02C; font-size: x-large">Good2</label>
                            <label id="positive2" style="color:#72C02C; font-size: large"><%positive2%>%</label>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Popularity by country -->
            <div class="row m-t-20 well bg-opc-65" ng-if="isCompared">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label>Criteria One</label>

                        <div id="chartContainer">Criteria One</div>
                    </div>
                    <div class="col-sm-6">
                        <label>Criteria Two</label>

                        <div id="chartContainer2">Criteria Two</div>
                    </div>
                </div>
            </div>

            <!-- ----------------- Trial Tweets ------------------------------->
            <div class="col-sm-12">
                <div ng-repeat="t in trialtweets">
                    <div ng-bind-html="t | unsafe"></div>
                </div>

            </div>

        </div>


    </div>
    <!-- ----------------------- Good Bad Tweets Section End ---------------------------------------------------------------------------------------- -->
@stop