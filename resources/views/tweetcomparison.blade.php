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


    <div class="container" ng-controller="tweetComparisonCtrl">

        <div class="row m-t-20 well">

            <div class="col-sm-1"></div>


            <!-- Search Section -->
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <h4>Search Criteria:</h4>
                </div>

                <div class="col-sm-11 col-xs-10">
                    <input id="search" class="form-control" type="text" ng-model="search" ng-keyup="$event.keyCode == 13 && getInfo()">
                </div>

                <div class="col-sm-11 col-xs-10">
                    <input id="search2" class="form-control" type="text" ng-model="search2" ng-keyup="$event.keyCode == 13 && getInfo()">
                </div>

                <div class="col-sm-1 col-xs-2">
                    <Button id="search-btn" class="btn btn-default" ng-click="getInfo()">
                        <i class="fa fa-search"></i>
                    </Button>
                </div>
            </div>
            <!--  -->

            <div class="col-sm-1"></div>


        </div>

        <div class="col-sm-12">
            <hr>

            <div ng-if="loading" style="
                    z-index: 1;
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(255, 255, 255, 0.64);
                    background-image: url('{{ URL::asset('images/loader.gif') }}');
                    background-repeat: no-repeat;
                    background-size: 150px 150px;
                    background-position: center;"></div>

            <!-- Bar Chart comparing the two -->
            <div class="col-sm-12 well">
                <div class="col-sm-6">
                    <label>Good comparison between each other</label>
                    <canvas id="bar" class="chart chart-bar" style="height:150px;"
                            chart-data="bardata2" chart-labels="barlabels2"  chart-options="baroptions2" chart-colors="barcolors2">
                    </canvas>
                </div>
                <div class="col-sm-6">
                    <label>Bad comparison between each other</label>
                    <canvas id="bar2" class="chart chart-bar" style="height:150px;"
                            chart-data="bardata" chart-labels="barlabels" chart-options="baroptions" chart-colors="barcolors">
                    </canvas>
                </div>
            </div>

            <!-- Pie charts describing each separately -->
            <div class="col-sm-12 well">
                <div class="col-sm-6">
                    <label>Criteria One</label>
                    <label style="color:#3498DB; font-size: x-large">Bad</label>
                    <label id="negative" style="color:#3498DB; font-size: large"><%negative%>%</label>
                    <canvas id="pie" class="chart chart-pie" style="height:60px;"
                            chart-data="data" chart-labels="labels" chart-options="options" chart-colors="colors">
                    </canvas>
                    <label style="color:#72C02C; font-size: x-large">Good</label>
                    <label id="positive" style="color:#72C02C; font-size: large"><%positive%>%</label>
                </div>
                <div class="col-sm-6">
                    <label>Criteria Two</label>
                    <label style="color:#3498DB; font-size: x-large">Bad2</label>
                    <label id="negative2" style="color:#3498DB; font-size: large"><%negative2%>%</label>
                    <canvas id="pie2" class="chart chart-pie" style="height:60px;"
                            chart-data="data2" chart-labels="labels2" chart-options="options2" chart-colors="colors2">
                    </canvas>
                    <label style="color:#72C02C; font-size: x-large">Good2</label>
                    <label id="positive2" style="color:#72C02C; font-size: large"><%positive2%>%</label>
                </div>
            </div>

            <!-- Popularity by country -->
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

            <!-- ----------------- Trial Tweets ------------------------------->
            <div class="col-sm-12">
                <div ng-repeat="t in trialtweets">
                    <div ng-bind-html="t | unsafe"></div>
                </div>

            </div>


            <!-- -------------------- Good Bad Tweets Section Start --------------------------------------------------------------- -->
            <div class="col-sm-12 well">
                <h4>This Week Most Popular <strong class="c-green">Goods</strong> & <strong class="c-red">Bads</strong> :</h4>

                <div class="row p-0">
                    {{--<div class="col-sm-6 col-xs-12">--}}
                    {{--<div class="col-xs-12 good-tweet gb-tweet" ng-repeat="items in positives">--}}
                    {{--<div ng-class="{'showingAnalyzer': topAnalyzer['pos'][items['number']]}" ng-click="loadHowSentimentWorks(items['number'], 'pos')" title="Analyze" style="cursor: pointer; border:1px solid black; width: 18px; height: 21px; position: absolute; top: 0; right: 0; border-radius: 15px 0 0 15px">--}}
                    {{--<i style="margin-left: 3px;" class="fa fa-search" aria-hidden="true"></i>--}}
                    {{--</div>--}}
                    {{--<div ng-if="justTweets['pos'][items['number']]" class="just-tweet" style="margin-top: 5px;">--}}
                    {{--<div tweet="items['text']" top-tweet></div>--}}
                    {{--<div class="pull-left" style="margin-top: 10px">--}}
                    {{--<span>by <label style="color: blue;"><%items['user']%></label></span>--}}
                    {{--</div>--}}
                    {{--<div class="pull-right" style="margin-top: 10px">--}}
                    {{--<label><i class="fa fa-retweet" aria-hidden="true"></i> <%items['retweet']%></label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div ng-if="topAnalyzer['pos'][items['number']]" class="tweet-analyzer">--}}
                    {{--<span ng-class="{'analytic-tooltip' : span['color'] != 'black'}" ng-repeat="span in items['analyzed']" style="font-weight: bold; color: <%span['color']%>"><%span['word']%>--}}
                    {{--<span ng-if="span['color'] != 'black'" class="analytic-tooltiptext"><%span['value']%></span>--}}
                    {{--</span>--}}
                    {{--<span> </span>--}}
                    {{--<div style="margin-top: 10px; text-align: center">--}}
                    {{--<label style="text-decoration: underline; color: green">Total:  + <%items['total']%></label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="col-xs-12 visible-xs">
                        <hr>
                    </div>

                    {{--<div class="col-sm-6 col-xs-12">--}}
                    {{--<div class="col-xs-12 bad-tweet gb-tweet" ng-repeat="items in negatives">--}}
                    {{--<div ng-class="{'showingAnalyzer': topAnalyzer['neg'][items['number']]}" ng-click="loadHowSentimentWorks(items['number'], 'neg')" title="Analyze" style="cursor: pointer; border:1px solid black; width: 18px; height: 21px; position: absolute; top: 0; right: 0; border-radius: 15px 0 0 15px">--}}
                    {{--<i style="margin-left: 3px;" class="fa fa-search" aria-hidden="true"></i>--}}
                    {{--</div>--}}
                    {{--<div ng-if="justTweets['neg'][items['number']]" class="just-tweet" style="margin-top: 5px;">--}}
                    {{--<div tweet="items['text']" top-tweet></div>--}}
                    {{--<div class="pull-left" style="margin-top: 10px">--}}
                    {{--<span>by <label style="color: blue;"><%items['user']%></label></span>--}}
                    {{--</div>--}}
                    {{--<div class="pull-right" style="margin-top: 10px">--}}
                    {{--<label><i class="fa fa-retweet" aria-hidden="true"></i> <%items['retweet']%></label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div ng-if="topAnalyzer['neg'][items['number']]" class="tweet-analyzer">--}}
                    {{--<span ng-class="{'analytic-tooltip' : span['color'] != 'black'}" ng-repeat="span in items['analyzed']" style="font-weight: bold; color: <%span['color']%>"><%span['word']%>--}}
                    {{--<span ng-if="span['color'] != 'black'" class="analytic-tooltiptext"><%span['value']%> </span>--}}
                    {{--</span>--}}
                    {{--<div style="margin-top: 10px; text-align: center">--}}
                    {{--<label style="text-decoration: underline; color: red">Total:  - <%items['total']%></label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>



        {{--<div id="sentiment-howto" style="display: none">--}}
        {{--<table class="table table-hover">--}}
        {{--<tr style="text-align: center" class="row" ng-repeat="text in mouseHovered">--}}
        {{--<td>--}}
        {{--<label style="color:<%text['color']%>"><%text['str']%></label>--}}
        {{--</td>--}}
        {{--<td>--}}
        {{--<label><%text['value']%></label>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td>--}}
        {{--<label style="color:<%totalColor%>"><%totalType%></label>--}}
        {{--</td>--}}
        {{--<td>--}}
        {{--<label style="color:<%totalColor%>"><%totalValue%></label>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--</table>--}}
        {{--</div>--}}
    </div>
    <!-- ----------------------- Good Bad Tweets Section End ---------------------------------------------------------------------------------------- -->
@stop
<script type="text/javascript" src="js/fusioncharts/fusioncharts.js"></script>
<script type="text/javascript" src="js/fusioncharts/themes/fusioncharts.theme.fint.js"></script>