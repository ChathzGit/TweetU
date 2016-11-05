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

<!Doctype html>
<html ng-app="myApp">
<head>
    <title>Profile analysis</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/angular.min.js') }}"></script>
    <script src="{{ asset('/js/profile-passer.js') }}"></script>
</head>
<body>
    <div class="container">

        <div class="quote" ng-controller="ctrlProf">

            <!-- --------------------------------------------------------------------------------------------------------------- -->
            <div class="col-sm-8 m-t-20 well "  style="margin-left: 15%">
                <div class="col-sm-12">
                    <h4>Profile Name</h4>
                </div>

                <div class="col-xs-12" >
                    <div class="col-xs-8">
                        <input class="form-control" ng-model="searchCriteria">
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-default" ng-click="loadProfiles()">
                            <i class="fa fa-search"></i> SEARCH
                        </button>
                    </div>
                </div>

            </div>
            <!-- --------------------------------------------------------------------------------------------------------------- -->

            <div class="col-xs-6 col-sm-6 " id="searchResult">
                <div ng-show="profiles.length == 0">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div ng-show="profiles.length >0" ng-repeat="items in profiles">
                    <table class="table">
                        <tr class="col-xs-12 profiles profile-search">
                            <td class="col-xs-2"><img src="<%items['url']%>" height="42" width="42"></td>
                            <td class="col-xs-8">
                                <label><%items["name"]%></label>
                                <i class="fa-li fa fa-check-square" ng-show="items['verify']"></i>
                            </td>
                            <td>
                                <button ng-click="loadSelection($index)">Check Profile</button>
                            </td>
                        </tr>

                    </table>
                    <br>
                </div>
            </div>

            <div class="col-sm-12 col-xs-12">
                <div class="col-xs-12" style="border: dotted">
                    <table class="table">
                        <tr>
                            <td ><img src="<% selectedAccount['url'] %>" height="80" width="80"></td>
                        </tr>
                        <tr>
                            <td>Profile Name :</td>
                            <td><label><% selectedAccount["name"] %></label></td>

                        </tr>
                        <tr>
                            <td>FollowersS :</td>
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
                            <td>Description :</td>
                            <td><label><% selectedAccount["description"] %></label></td>
                        </tr>
                        <tr>
                            <td>Location :</td>
                            <td><label><% selectedAccount["location"] %></label></td>
                        </tr>
                        <tr>
                            <td>Created At :</td>
                            <td><label><% selectedAccount["createdAt"] %></label></td>
                        </tr>
                        <tr>
                            <td><button class="btn btn-primary" ng-click="loadTweets(selectedAccount['screenName'])">Analise Profile</button></td>
                        </tr>

                    </table>
                </div>
            </div>

            {{--<div ng-show="tweets.length == 0">--}}
                {{--<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>--}}
                {{--<span class="sr-only">Loading...tweet</span>--}}
            {{--</div>--}}

            <div ng-show="tweets.length==0">
                <label>Unauthorized access!</label>
            </div>

            <div class="col-sm-12" ng-show="tweets.length >0" ng-repeat="items in tweets">
                <table class="table">
                    <tr class="col-xs-12 profiles profile-search">
                        <td class="col-xs-8">
                            <label><%items["text"]%></label>
                        </td>
                    </tr>

                </table>
                <br>
            </div>

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

        </div>
    </div>
</body>
</html>
