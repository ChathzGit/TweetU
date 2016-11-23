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




    <div class="container-fluid" ng-controller="ctrlInfoProf">

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
                            <input id="search" class="form-control" type="text" ng-model="searchCriteria1"
                                   placeholder="First Account"
                                   ng-keyup="$event.keyCode == 13 && loadProfiles()">
                        </div>

                        <div class="col-sm-6 col-xs-12 m-b-5">
                            <input id="search" class="form-control" type="text" ng-model="searchCriteria2"
                                   placeholder="Second Account"
                                   ng-keyup="$event.keyCode == 13 && loadProfiles()">
                        </div>
                    </div>

                    <div class="col-sm-1 col-xs-2">
                        <Button id="search-btn" class="btn btn-default" ng-click="loadProfiles()">
                            <i class="fa fa-search"></i>
                        </Button>
                    </div>

                    <div class="col-sm-12 m-t-20" ng-if="!isSearched">
                        <hr>
                        <p class="text-grey text-center">Analyze two accounts simultaneously, and compare the public
                            perception of
                            the two. Good for
                            comparing two people.</p>
                    </div>


                </div>

                <div class="col-sm-1"></div>


            </div>


            <!-- --------------------------------------------------------------------------------------------------------------- -->


            <div class="row m-t-20 well bg-opc-65" ng-if="isSearched">

                <div class="col-xs-12 col-sm-6 p-l-10 p-r-10">


                    <div class="col-sm-12 m-b-5">
                        <h3 class="text-center">Select First Account:</h3>
                    </div>

                    <div class="col-xs-12" ng-show="profiles1.length >0" ng-if="isclicked1stprof"
                         style="height: 400px; overflow: scroll; margin-bottom: 10px;">


                        <div class="col-xs-12 selected-profile m-b-5" ng-repeat="items in profiles1">

                            <div class="col-xs-2"><img src="<%items['url']%>" height="42" width="42"></div>

                            <div class="col-xs-10">
                                <div class="col-xs-12 col-sm-7">

                                    <strong><%items["name"]%></strong><i class="fa-li fa fa-check-circle text-twitter"
                                                                         ng-show="items['verify']"></i>


                                </div>

                                <div class="col-xs-12 col-sm-5">
                                    <button class="btn btn-twitter-custom" ng-click="selectFirstProfile($index)">Select
                                        Profile
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="col-xs-12 p-t-10 p-b-10 selected-profile compare-profile-one"
                            {{--style="border: solid; border-color: #66ccff" --}}
                         ng-if="firstprofileselected">

                        <div class="col-sm-3 col-xs-12 text-center">
                            <img src="<% selectedFirstProfile['url'] %>" height="80" width="80">
                        </div>

                        <div class="col-sm-9 col-xs-12 text-center">
                            <div class="col-sm-12">
                                <label><% selectedFirstProfile["name"] %></label>
                            </div>
                            <div class="col-sm-12 col-xs-12 text-center hidden-xs">
                                <p class="text-grey">
                                    <% selectedFirstProfile["description"] %>
                                </p>
                            </div>

                            <div class="col-sm-12 text-center">
                                <button class="btn btn-twitter-custom btn-side-padding btn-full-width"
                                        ng-click="SelectOtherFirst()">
                                    Select Different Account
                                </button>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 p-l-10 p-r-10">

                    <div class="col-sm-12 col-xs-12 m-b-5">
                        <h3 class="text-center">Select Second Account:</h3>
                    </div>

                    <div class="col-xs-12" ng-show="profiles1.length >0" ng-if="isclicked2ndprof"
                         style="height: 400px; overflow: scroll; margin-bottom: 10px;">


                        <div class="col-xs-12 selected-profile m-b-5" ng-repeat="items in profiles2">

                            <div class="col-xs-2"><img src="<%items['url']%>" height="42" width="42"></div>

                            <div class="col-xs-10">
                                <div class="col-xs-12 col-sm-7">

                                    <strong><%items["name"]%></strong><i class="fa-li fa fa-check-circle text-twitter"
                                                                         ng-show="items['verify']"></i>


                                </div>

                                <div class="col-xs-12 col-sm-5">
                                    <button class="btn btn-twitter-custom" ng-click="selectSecondProfile($index)">Select
                                        Profile
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="col-xs-12 p-t-10 p-b-10 selected-profile compare-profile-two"
                            {{--style="border: solid; border-color: #66ccff" --}}
                         ng-if="secondprofileselected">

                        <div class="col-sm-3 col-xs-12 text-center">
                            <img src="<% selectedSecondProfile['url'] %>" height="80" width="80">
                        </div>

                        <div class="col-sm-9 col-xs-12 text-center">
                            <div class="col-sm-12">
                                <label><% selectedSecondProfile["name"] %></label>
                            </div>
                            <div class="col-sm-12 col-xs-12 hidden-xs">
                                <p class="text-grey text-center">
                                    <% selectedSecondProfile["description"] %>
                                </p>
                            </div>

                            <div class="col-sm-12 text-center">
                                <button class="btn btn-twitter-custom btn-side-padding btn-full-width"
                                        ng-click="SelectOtherSecond()">
                                    Select Different Account
                                </button>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="col-sm-12 col-xs-12">
                    <hr>
                </div>


                <div class="col-sm-12 col-xs-12" ng-if="firstprofileselected && secondprofileselected">

                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        <button class="btn btn-twitter-custom btn-full-width p-10"
                                ng-click="Compare()">
                            <strong>Compare Accounts</strong>
                        </button>
                    </div>

                    <div class="col-sm-3"></div>


                </div>


            </div>

            {{----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------}}


            <div class="row m-t-20 well bg-opc-65" ng-if="compare">
                <div class="col-xs-12 col-sm-6 p-l-10 p-r-10">

                    <div class="col-sm-12 col-xs-12">
                        <h4>Twitter Popularity:</h4>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-12 col-xs-12">
                            <canvas id="pie" class="chart chart-pie" style="height:160px;"
                                    chart-data="data" chart-labels="labels" chart-options="options"
                                    chart-colors="colors">
                            </canvas>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <table class="table">
                            <tr>
                                <td style="border: none">
                                    <div style="height: 10px; width: 10px; background-color: #55acee"></div>
                                </td>
                                <td style="border: none"> <% selectedFirstProfile["name"] %> </td>
                            </tr>

                            <tr>
                                <td style="border: none">
                                    <div style="height: 10px; width: 10px; background-color: #4078a2"></div>
                                </td>
                                <td style="border: none"> <% selectedSecondProfile["name"] %> </td>
                            </tr>
                        </table>

                    </div>

                </div>

                <div class="col-xs-12 visible-xs">
                    <hr>
                </div>


                <div class="col-xs-12 col-sm-6 p-l-10 p-r-10" ng-if="compare">

                    <div class="col-sm-12 col-xs-12">
                        <h4>Twitter Usage:</h4>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-6 col-xs-6">
                            <canvas id="pie2" class="chart chart-pie" style="height:160px;"
                                    chart-data="data1" chart-labels="labels1" chart-options="options1"
                                    chart-colors="colors">
                            </canvas>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <table class="table">
                            <tr>
                                <td style="border: none">
                                    <div style="height: 10px; width: 10px; background-color: #55acee"></div>
                                </td>
                                <td style="border: none"> <% selectedFirstProfile["name"] %> </td>
                            </tr>

                            <tr>
                                <td style="border: none">
                                    <div style="height: 10px; width: 10px; background-color: #4078a2"></div>
                                </td>
                                <td style="border: none"> <% selectedSecondProfile["name"] %> </td>
                            </tr>
                        </table>

                    </div>

                </div>
            </div>



        </div>

    </div>

