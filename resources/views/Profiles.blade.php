<?php
/**
 * Created by PhpStorm.
 * User: Kasun
 * Date: 9/23/2016
 * Time: 4:02 PM
 */
?>

@extends('pages.index')

@section('content')


    <div class="container-fluid" ng-controller="ctrlProf">

        <div class="loading-gif-one"
             ng-if="loading"
                ></div>

        <div class="container">


            <!-- --------------------------------------------------------------------------------------------------------------- -->
            <div class="row m-t-20 well bg-opc-65">


                <div class="col-sm-1"></div>

                <div class="col-sm-10">


                    <div class="col-sm-11 col-xs-10">
                        <input id="search" class="form-control" type="text" ng-model="searchCriteria"
                               placeholder="Search For Account"
                               ng-keyup="$event.keyCode == 13 && loadProfiles()">
                    </div>

                    <div class="col-sm-1 col-xs-2">
                        <Button id="search-btn" class="btn btn-default" ng-click="loadProfiles()">
                            <i class="fa fa-search"></i>
                        </Button>
                    </div>

                    <div class="col-sm-12 col-xs-12 m-t-20" ng-if="!isSearched">
                        <hr>
                        <p class="text-grey text-center">Analyze a twitter account. Want to see how your favorite
                            celebrity
                            is
                            received by the public?
                            give it a try!</p>
                    </div>


                </div>

                <div class="col-sm-1"></div>


            </div>


            <!-- --------------------------------------------------------------------------------------------------------------- -->


            <div class="row m-t-20 well bg-opc-65" ng-if="issearched">


                <div class="col-xs-12 col-sm-5"
                     style="height: 400px; overflow: scroll; padding-top: 20px; margin-bottom: 10px;">

                    <div ng-show="profiles.length >0">


                        <div class="col-xs-12 selected-profile m-b-5" ng-repeat="items in profiles">

                            <div class="col-xs-2"><img src="<%items['url']%>" height="42" width="42"></div>

                            <div class="col-xs-10">
                                <div class="col-xs-12 col-sm-7">

                                    <strong><%items["name"]%></strong><i class="fa-li fa fa-check-circle text-twitter"
                                                                         ng-show="items['verify']"></i>


                                </div>

                                <div class="col-xs-12 col-sm-5">
                                    <button class="btn btn-twitter-custom" ng-click="loadSelection($index)">Select
                                        Profile
                                    </button>
                                </div>
                            </div>

                        </div>


                        <br>
                    </div>
                </div>

                <div class="col-sm-1">

                </div>

                <div class="col-xs-12 visible-xs">
                    <hr>
                </div>


                <div class="col-sm-6 col-xs-12 selected-profile" ng-if="isselected">

                    <div class="col-sm-12 text-center m-b-10">
                        <div class="col-sm-4">
                            <img style="margin: auto;" src="<% selectedAccount['url'] %>" height="80" width="80">
                        </div>

                        <div class="col-sm-8">
                            <h4><% selectedAccount["name"] %></h4>

                            <div class="col-sm-12 p-0">
                                <p class="text-grey"><% selectedAccount["description"] %></p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <table class="table">

                            <tr>
                                <td>Followers :</td>
                                <td><label><% selectedAccount["followersCount"] %></label></td>
                            </tr>
                            <tr>
                                <td>Likes :</td>
                                <td><label><% selectedAccount["favouritesCount"] %></label></td>
                            </tr>
                            <tr>
                                <td>Following :</td>
                                <td><label><% selectedAccount["friendsCount"] %></label></td>
                            </tr>

                            <tr>
                                <td>Location :</td>
                                <td><label><% selectedAccount["location"] %></label></td>
                            </tr>
                            <tr>
                                <td>Created On :</td>
                                <td><label><% selectedAccount["createdAt"] %></label></td>
                            </tr>

                        </table>
                    </div>

                    <div class="col-sm-12">
                        <button class="btn btn-twitter-custom btn-full-width"
                                ng-click="loadTweets(selectedAccount['screenName'])">
                            Analyze Profile
                        </button>
                    </div>
                </div>


                <!--Error Modal -->
                <script type="text/ng-template" id="NetworkError.html">
                    <div class="modal-body">
                        <button onclick="location.reload()" type="button" class="close" data-dismiss="modal"><i style="color: red" class="fa fa-refresh" aria-hidden="true"></i></button>
                        <h4 class="modal-title">Error in connection. Please retry...</h4>
                    </div>
                </script>

            </div>


            <div class="row m-t-20 well bg-opc-65" ng-if="isanalized">


                <div class="col-sm-12 p-0">


                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <h4><strong>Tweet Summary:</strong></h4>
                        </div>
                        <div class="col-sm-12">
                            <table class="table m-b-0">

                                <tr>
                                    <td>Total Tweets :</td>
                                    <td><label><% selectedAccount["tweetcount"] %></label></td>
                                </tr>
                                <tr>
                                    <td>Average tweets per day :</td>
                                    <td><label><% selectedAccount["tweetsperday"] | number:2 %></label></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <hr>
                    </div>


                    <div class="col-sm-12" ng-show="tweets.length >0">
                        <div class="col-sm-12">
                            <h4><strong>Recent Tweets:</strong></h4>
                        </div>
                        <div class="col-sm-12">


                            <div ng-repeat="items in tweets" class="col-xs-12 selected-profile m-b-5">
                                <p class="text-grey"><%items["text"]%></p>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <hr>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <h4><strong>Timeline Summary:</strong></h4>
                        </div>
                        <div class="col-sm-12">


                            <div class="col-sm-5 col-xs-12">
                                <div class="col-sm-12 p-0">
                                    <h4><strong>Top Hash Tags:</strong></h4>
                                </div>


                                <table class="table m-b-20">

                                    <tr ng-repeat="items in hashtags">
                                        <td><%HashtagKeys[$index]%></td>
                                        <td><label><%items%></label></td>
                                    </tr>

                                </table>

                                <div class="col-sm-12">
                                    <canvas id="pie" class="chart chart-pie"
                                            chart-data="data1" chart-labels="labels1" chart-options="options1">
                                    </canvas>
                                </div>

                            </div>

                            <div class="col-sm-1"></div>
                            <div class="col-xs-12 visible-xs">
                                <hr>
                            </div>

                            <div class="col-sm-5 col-xs-12">
                                <div class="col-sm-12 p-0">
                                    <h4><strong>Top User Mentions:</strong></h4>
                                </div>


                                <table class="table m-b-20">

                                    <tr ng-repeat="items in usermentions">
                                        <td><%UserMentionKeys[$index]%></td>
                                        <td><label><%items%></label></td>
                                    </tr>

                                </table>

                                <div class="col-sm-12">
                                    <canvas id="pie" class="chart chart-pie"
                                            chart-data="data2" chart-labels="labels2" chart-options="options2">
                                    </canvas>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <hr>
                    </div>


                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <h4><strong>Most retweeted tweets:</strong></h4>
                        </div>
                        <div class="col-sm-12" ng-repeat="items in retweets">
                            <div class="col-sm-9 col-xs-12 selected-profile m-b-5">
                                <p class="text-grey"><%RetweetKeys[$index]%></p>
                            </div>

                            <div class="col-sm-3 col-xs-12 m-t-5">
                                <label class="text-grey"><%items%> retweets</label>
                            </div>

                            <div class="col-xs-12 visible-xs">
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <hr>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <button class="btn btn-twitter-custom btn-full-width"
                                    ng-click="loadLocation(selectedAccount['screenName'])">Generate Followers Map
                            </button>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>

                    <div class="col-sm-12 col-xs-12 m-t-20">
                        <div id="chartContainer"></div>
                    </div>


                </div>


            </div>


        </div>
    </div>

    <script type="text/javascript" src="js/fusioncharts/fusioncharts.js"></script>
    <script type="text/javascript" src="js/fusioncharts/themes/fusioncharts.theme.fint.js"></script>