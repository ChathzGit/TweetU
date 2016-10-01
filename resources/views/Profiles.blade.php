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

            <div class="col-xs-6 col-sm-6 ">
                <div ng-show="profiles.length == 0">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div ng-show="profiles.length >0" ng-repeat="items in profiles">
                    <table class="table">
                        <tr class="col-xs-12 good-tweet gb-tweet">
                            <td class="col-xs-2"><img src="<%items['url']%>" height="42" width="42"></td>
                            <td class="col-xs-8">
                                <label><%items["name"]%></label>
                                <i class="fa-li fa fa-check-square" ng-show="items['verify']"></i>
                            </td>
                            {{--<td><label><%items["followersCount"]%></label></td>--}}
                            {{--<td><label><%items["description"]%></label></td>--}}
                            {{--<td><label><div ng-model="account.original"><%items["verify"]%></div></label></td>--}}

                            
                            <td>
                                <button ng-click="loadSelection($index)">Check Profile</button>
                            </td>
                        </tr>

                    </table>
                    <br>
                </div>
            </div>

            <div class="col-sm-6 col-xs-12">
                <div class="col-xs-12">
                    <label><% selectedAccount["name"] %></label>
                </div>
            </div>

        </div>
    </div>
</body>
</html>