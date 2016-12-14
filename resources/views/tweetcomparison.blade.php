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

                    <div class="col-sm-12 col-xs-12 m-t-20" ng-if="!isSearched">
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
                <div class="col-sm-12 p-0">
                    <div class="col-sm-12" style="text-align: center"><label>Popularity and Unpopularity of the two criteria as percentages</label></div>
                    <div class="col-sm-6 well">
                        <label>'Good' Popularity (%)</label>
                        <canvas id="bar" class="chart chart-bar" style="height:250px;"
                                chart-data="bardata2" chart-labels="barlabels2" chart-colors="barcolors2">
                        </canvas>
                    </div>
                    <div class="col-sm-6 well">
                        <label>'Bad' Popularity (%)</label>
                        <canvas id="bar2" class="chart chart-bar" style="height:250px;"
                                chart-data="bardata" chart-labels="barlabels" chart-colors="barcolors">
                        </canvas>
                    </div>
                </div>
            </div>


            <!-- Pie charts describing each separately -->
            <div class="row m-t-20 well bg-opc-65" ng-if="isCompared">

                <div class="col-sm-12">
                    <div class="col-sm-12" style="text-align: center"><label>Separate analysation of the two criteria</label></div>
                    <div class="col-sm-6 col-xs-12 well">
                        <div class="col-sm-12" style="text-align: center"><label id="criteria_one"><%criteria_one%></label></div>
                        <div class="col-sm-12" style="text-align: center"></div>
                        <div class="col-sm-12" style="text-align: center"><label>Percentage of 'Good' Tweets and 'Bad' Tweets</label></div>
                        <canvas id="pie" class="chart chart-pie" style="height:60px;"
                                chart-data="data" chart-labels="labels" chart-options="options" chart-colors="colors">
                        </canvas>
                        <table class="table">
                            <thead>
                            <th style="text-align: center"><label style="color:#72C02C; font-size: x-large">Good</label></th>
                            <th style="text-align: center"><label style="color:#3498DB; font-size: x-large">Bad</label></th>
                            </thead>
                            <tbody>
                            <td style="text-align: center"><label id="positive" style="color:#72C02C; font-size: large"><%positive%>%</label></td>
                            <td style="text-align: center"><label id="negative" style="color:#3498DB; font-size: large"><%negative%>%</label></td>
                            </tbody>
                        </table>
                        <div id="chartContainer" style="text-align: center">Criteria One</div>
                        <div class="col-sm-12" style="text-align: center"><label>Some 'Good' Tweets</label></div>
                        <div class="col-sm-12">
                            <div ng-repeat="t in postrialtweets track by $index">
                                <div ng-bind-html="t | unsafe"></div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="text-align: center"><label>Some 'Bad' Tweets</label></div>
                        <div class="col-sm-12">
                            <div ng-repeat="t in negtrialtweets track by $index">
                                <div ng-bind-html="t | unsafe"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12 well">
                        <div class="col-sm-12" style="text-align: center"><label id="criteria_two"><%criteria_two%></label></div>
                        <div class="col-sm-12" style="text-align: center"></div>
                        <div class="col-sm-12" style="text-align: center"><label>Percentage of 'Good' Tweets and 'Bad' Tweets</label></div>
                        <canvas id="pie2" class="chart chart-pie" style="height:60px;"
                                chart-data="data2" chart-labels="labels2" chart-options="options2" chart-colors="colors2">
                        </canvas>
                        <table class="table">
                            <thead>
                            <th style="text-align: center"><label style="color:#FFC0CB; font-size: x-large">Good</label></th>
                            <th style="text-align: center"><label style="color:#FFFF00; font-size: x-large">Bad</label></th>
                            </thead>
                            <tbody>
                            <td style="text-align: center"><label id="positive2" style="color:#FFC0CB; font-size: large"><%positive2%>%</label></td>
                            <td style="text-align: center"><label id="negative2" style="color:#FFFF00; font-size: large"><%negative2%>%</label></td>
                            </tbody>
                        </table>
                        <div id="chartContainer2" style="text-align: center">Criteria Two</div>
                        <div class="col-sm-12" style="text-align: center"><label>Some 'Good' Tweets</label></div>
                        <div class="col-sm-12">
                            <div ng-repeat="t in postrialtweets2 track by $index">
                                <div ng-bind-html="t | unsafe"></div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="text-align: center"><label>Some 'Bad' Tweets</label></div>
                        <div class="col-sm-12">
                            <div ng-repeat="t in negtrialtweets2 track by $index">
                                <div ng-bind-html="t | unsafe"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ----------------- Trial Tweets ------------------------------->


        </div>

        <!--Error Modal -->
        <script type="text/ng-template" id="NetworkError.html">
            <div class="modal-body">
                <button onclick="location.reload()" type="button" class="close" data-dismiss="modal"><i style="color: red" class="fa fa-refresh" aria-hidden="true"></i></button>
                <h4 class="modal-title">Error in connection. Please retry...</h4>
            </div>
        </script>
    </div>
    <!-- ----------------------- Good Bad Tweets Section End ---------------------------------------------------------------------------------------- -->
@stop