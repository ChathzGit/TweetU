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
                        <input id="search" class="form-control" type="text" ng-model="searchCriteria" placeholder="Search For Account"
                               ng-keyup="$event.keyCode == 13 && loadProfiles()">
                    </div>

                    <div class="col-sm-1 col-xs-2">
                        <Button id="search-btn" class="btn btn-default" ng-click="getInfo()">
                            <i class="fa fa-search"></i>
                        </Button>
                    </div>


                </div>

                <div class="col-sm-1"></div>


            </div>


            <!-- --------------------------------------------------------------------------------------------------------------- -->


            <div class="row m-t-20 well bg-opc-65" ng-if="issearched">


                <div class="col-xs-12 col-sm-5"
                     style="height: 400px; overflow: scroll; padding-top: 20px; margin-bottom: 10px;">

                    <div ng-show="profiles.length >0" ng-repeat="items in profiles">
                        <table class="table">
                            <tr class="col-xs-12 profiles profile-search">
                                <td class="col-xs-2"><img src="<%items['url']%>" height="42" width="42"></td>
                                <td class="col-xs-8">
                                    <label><%items["name"]%></label>
                                    <i class="fa-li fa fa-check-square" ng-show="items['verify']"></i>
                                </td>
                                <td>
                                    <button class="btn btn-twitter-custom" ng-click="loadSelection($index)">Select Profile
                                    </button>
                                </td>
                            </tr>

                        </table>
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
                        <button class="btn btn-twitter-custom btn-full-width" ng-click="loadTweets(selectedAccount['screenName'])">
                            Analyze Profile
                        </button>
                    </div>
                </div>


            </div>


            <div class="col-sm-12" ng-if="isanalized">
                <div class="col-sm-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">Tweets</div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <td>Total Tweets</td>
                                    <td><% selectedAccount["tweetcount"] %> </td>
                                </tr>
                                <tr>
                                    <td>Average tweets per day</td>
                                    <td><% selectedAccount["tweetsperday"] %></td>
                                </tr>
                            </table>

                        </div>
                    </div>

                </div>


                <div class="col-sm-12" ng-show="tweets.length >0" ng-repeat="items in tweets">
                    <div>Recent Tweets of the user</div>
                    <table class="table">
                        <tr class="col-xs-12 profiles profile-search">
                            <td class="col-xs-8">
                                <label><%items["text"]%></label>
                            </td>
                        </tr>

                    </table>
                    <br>
                </div>


                <div class="row col-sm-12">
                    <div>Summary of user timeline</div>
                    <h3>Top Hash Tags Used</h3>

                    <div class="col-sm-6">
                        <div ng-repeat="items in hashtags">
                            <table class="table">
                                <tr>
                                    <label><%HashtagKeys[$index]%></label> -
                                    <label><%items%></label>
                                </tr>

                            </table>
                            <br>
                        </div>

                        <canvas id="pie" class="chart chart-pie"
                                chart-data="data1" chart-labels="labels1" chart-options="options1">
                        </canvas>

                    </div>


                    <h3>Top User Mentions</h3>

                    <div class="col-sm-6">
                        <div ng-repeat="items in usermentions">
                            <table class="table">
                                <tr>
                                    <label><%UserMentionKeys[$index]%></label> -
                                    <label><%items%></label>
                                </tr>

                            </table>
                            <br>
                        </div>

                        <canvas id="pie" class="chart chart-pie"
                                chart-data="data2" chart-labels="labels2" chart-options="options2">
                        </canvas>
                    </div>
                </div>

                <div class="row col-sm-12">
                    <h3>Most retweeted tweets</h3>

                    <div class="col-sm-12" ng-repeat="items in retweets">
                        <table class="table">
                            <tr class="col-xs-12 ">
                                <td class="col-xs-8 profiles profile-search">
                                    <label><%RetweetKeys[$index]%></label>
                                </td>
                                <td>
                                    <label> retweets - <%items%></label>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

