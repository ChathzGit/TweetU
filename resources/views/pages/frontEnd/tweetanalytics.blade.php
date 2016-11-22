{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the home page
--
--}}

@extends('pages.index')

@section('content')

    <div class="container-fluid" ng-controller="posNegSentiment">

        <div class="loading-gif-one"
             ng-if="loading"></div>

        <div class="container">


            <!-- ---------------- Search Topic Section Start ------------------------------------------------------------------------------------------- -->
            <div class="row m-t-20 well bg-opc-65">

                <div class="col-sm-1"></div>


                <!-- --------------------------------------------------------------------------------------------------------------- -->
                <div class="col-sm-10">
                    <div class="col-sm-11 col-xs-10">
                        <input id="search" class="form-control" type="text" ng-model="search" placeholder="Search Topics"
                               ng-keyup="$event.keyCode == 13 && getInfo()">
                    </div>

                    <div class="col-sm-1 col-xs-2">
                        <Button id="search-btn" class="btn btn-default" ng-click="getInfo()">
                            <i class="fa fa-search"></i>
                        </Button>
                    </div>
                </div>
                <!-- --------------------------------------------------------------------------------------------------------------- -->

                <div class="col-sm-1"></div>


            </div>
            <!-- ---------------- Search Topic Section End ------------------------------------------------------------------------------------------- -->


            <!-- ---------------- Pie Chart Section Start ------------------------------------------------------------------------------------------- -->
            <div class="row m-t-20 well bg-opc-65">
                <div class="col-sm-12">


                    <div class="col-sm-12 col-xs-12">
                        <h4>Pie Chart:</h4>

                        <div class="col-sm-3 col-xs-12">
                            <p class="text-grey hidden-xs">
                                This chart displays the 'positive' and 'negative' tweets related to the topic you've entered.
                            </p>

                            <p class="text-grey hidden-xs">
                                After the request is made, please wait a moment as the chart is populated.
                            </p>
                        </div>

                        <div class="col-sm-1"></div>


                        <div class="col-sm-4">
                            <canvas id="twitterAnalyticsPie"
                                    class="chart chart-pie"
                                    chart-data="data"
                                    chart-labels="labels"
                                    chart-colors="colors"
                                    chart-options="options"
                                    width="200" height="200"></canvas>
                        </div>

                        <div class="col-sm-1"></div>

                        <div class="col-sm-3 col-xs-12" style="margin-top: 20px; padding: 0;">
                            <h4 class="text-grey">Legend:</h4>

                            <div class="col-sm-12 col-xs-6" style="margin-bottom: 10px; padding:0">
                                <div style="display: inline-block; margin-right: 5px; height: 15px; width: 15px; background-color: #77c0f8;"></div><span class="text-grey">Positive</span>
                            </div>

                            <div class="col-sm-12 col-xs-6" style="margin-bottom: 10px; padding:0">
                                <div style="display: inline-block; margin-right: 5px; height: 15px; width: 15px; background-color: #4078a2;"></div><span class="text-grey">Negative</span>
                            </div>

                            <div class="col-sm-12 col-xs-12 text-grey" style="margin-bottom: 10px; padding:0">
                                <p><strong><%tweetChecked%></strong> tweets analyzed</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ---------------- Pie Chart Section End ------------------------------------------------------------------------------------------- -->


            <!-- -------------------- Good Bad Tweets Section Start --------------------------------------------------------------- -->
            <div class="row m-t-20 well bg-opc-65">
                <div class="col-sm-12">
                    <h4 class="m-b-20">This Week's Most Popular <strong class="c-green">Positive Tweets</strong> & <strong
                                class="c-red">Negative Tweets</strong> :</h4>

                    <div class="row p-0">
                        <div class="col-sm-6 col-xs-12">
                            <div class="col-xs-12 good-tweet gb-tweet" ng-repeat="items in positives">
                                <div ng-class="{'showingAnalyzer': topAnalyzer['pos'][items['number']]}"
                                     ng-click="loadHowSentimentWorks(items['number'], 'pos')" title="Analyze"
                                     style="cursor: pointer; border:1px solid black; width: 18px; height: 21px; position: absolute; top: 0; right: 0; border-radius: 15px 0 0 15px">
                                    <i style="margin-left: 3px;" class="fa fa-search" aria-hidden="true"></i>
                                </div>
                                <div ng-if="justTweets['pos'][items['number']]" class="just-tweet"
                                     style="margin-top: 5px;">
                                    <div tweet="items['text']" top-tweet></div>
                                    <div class="pull-left" style="margin-top: 10px">
                                        <span>by <label style="color: blue;"><%items['user']%></label></span>
                                </div>
                                <div class="pull-right" style="margin-top: 10px">
                                    <label><i class="fa fa-retweet" aria-hidden="true"></i> <%items['retweet']%></label>
                                </div>
                            </div>
                            <div ng-if="topAnalyzer['pos'][items['number']]" class="tweet-analyzer">
                                <span ng-class="{'analytic-tooltip' : span['color'] != 'black'}" ng-repeat="span in items['analyzed']" style="font-weight: bold; color: <%span['color']%>"><%span['word']%>
                                    <span ng-if="span['color'] != 'black'" class="analytic-tooltiptext"><%span['value']%></span>
                                </span>
                                <span> </span>
                                <div style="margin-top: 10px; text-align: center">
                                    <label style="text-decoration: underline; color: green">Total:  + <%items['total']%></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 visible-xs">
                        <hr>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="col-xs-12 bad-tweet gb-tweet" ng-repeat="items in negatives">
                            <div ng-class="{'showingAnalyzer': topAnalyzer['neg'][items['number']]}" ng-click="loadHowSentimentWorks(items['number'], 'neg')" title="Analyze" style="cursor: pointer; border:1px solid black; width: 18px; height: 21px; position: absolute; top: 0; right: 0; border-radius: 15px 0 0 15px">
                                <i style="margin-left: 3px;" class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            <div ng-if="justTweets['neg'][items['number']]" class="just-tweet" style="margin-top: 5px;">
                                <div tweet="items['text']" top-tweet></div>
                                <div class="pull-left" style="margin-top: 10px">
                                    <span>by <label style="color: blue;"><%items['user']%></label></span>
                                </div>
                                <div class="pull-right" style="margin-top: 10px">
                                    <label><i class="fa fa-retweet" aria-hidden="true"></i> <%items['retweet']%></label>
                                </div>
                            </div>
                            <div ng-if="topAnalyzer['neg'][items['number']]" class="tweet-analyzer">
                                <span ng-class="{'analytic-tooltip' : span['color'] != 'black'}" ng-repeat="span in items['analyzed']" style="font-weight: bold; color: <%span['color']%>"><%span['word']%>
                                    <span ng-if="span['color'] != 'black'" class="analytic-tooltiptext"><%span['value']%> </span>
                                </span>
                                <div style="margin-top: 10px; text-align: center">
                                    <label style="text-decoration: underline; color: red">Total:  - <%items['total']%></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
            <!-- -------------------- Good Bad Tweets Section End --------------------------------------------------------------- -->

        </div>

        <div id="sentiment-howto" style="display: none">
            <table class="table table-hover">
                <tr style="text-align: center" class="row" ng-repeat="text in mouseHovered">
                    <td>
                        <label style="color:<%text['color']%>"><%text['str']%></label>
                    </td>
                    <td>
                        <label><%text['value']%></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label style="color:<%totalColor%>"><%totalType%></label>
                    </td>
                    <td>
                        <label style="color:<%totalColor%>"><%totalValue%></label>
                    </td>
                </tr>
            </table>
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