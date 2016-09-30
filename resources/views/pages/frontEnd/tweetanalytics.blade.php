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


    <div class="container" ng-controller="posNegSentiment">

        <div class="row m-t-20 well">

            <div class="col-sm-1"></div>


            <!-- --------------------------------------------------------------------------------------------------------------- -->
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <h4>Search Criteria:</h4>
                </div>

                <div class="col-sm-11 col-xs-10">
                    <input id="search" class="form-control" type="text" ng-model="search">
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

            <!-- ---------------- Pie Chart Section Start ------------------------------------------------------------------------------------------- -->
            <div class="col-sm-12 well">
                <h4>Pie Chart:</h4>

                <div class="col-sm-4"></div>

                <div class="col-sm-4">
                    <canvas class="chart chart-pie" chart-data="data" chart-labels="labels" chart-options="options" width="200" height="200"></canvas>
                </div>

                <div class="col-sm-4"></div>

            </div>
            <!-- ---------------- Pie Chart Section End ------------------------------------------------------------------------------------------- -->

            <div class="col-sm-12">
                <hr>
            </div>


            <!-- -------------------- Good Bad Tweets Section Start --------------------------------------------------------------- -->
            <div class="col-sm-12 well">
                <h4>This Week Most Popular <strong class="c-green">Goods</strong> & <strong class="c-red">Bads</strong> :</h4>

                <div class="row p-0">
                    <div class="col-sm-6 col-xs-12">
                        <div class="col-xs-12 good-tweet gb-tweet" ng-repeat="items in positives">
                            <div tweet="items['text']" top-tweet></div>
                            <div class="pull-left">
                                <label>by <span style="color: blue;"><%items['user']%></span></label>
                            </div>
                            <div class="pull-right">
                                <label><i class="fa fa-retweet" aria-hidden="true"></i><%items['retweet']%></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 visible-xs">
                        <hr>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="col-xs-12 bad-tweet gb-tweet" ng-repeat="items in negatives">
                            <div tweet="items['text']" top-tweet></div>
                            <div class="pull-left">
                                <label>by <span style="color: blue;"><%items['user']%></span></label>
                            </div>
                            <div class="pull-right">
                                <label><i class="fa fa-retweet" aria-hidden="true"></i><%items['retweet']%></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------- Good Bad Tweets Section End ---------------------------------------------------------------------------------------- -->


    <!-- Script to Activate the Carousel -->
    {{--<script>--}}
        {{--$('.carousel').carousel({--}}
            {{--interval: 5000 //changes the speed--}}
        {{--});--}}


        {{--var options = {--}}
            {{--labels: [--}}
                {{--"Good",--}}
                {{--"Bad"--}}
            {{--],--}}
            {{--datasets: [--}}
                {{--{--}}
                    {{--backgroundColor: [--}}
                        {{--"#66ff66",--}}
                        {{--"#ff471a"--}}
                    {{--],--}}
                    {{--hoverBackgroundColor: [--}}
                        {{--"#009900",--}}
                        {{--"#C40D0D"--}}
                    {{--]--}}
                {{--}]--}}
        {{--};--}}


        {{--var ctx = document.getElementById("myChart");--}}

        {{--new Chart(ctx,{--}}
            {{--type: 'pie',--}}
            {{--data: data--}}
        {{--});--}}

        {{--$(ctx).click(function(){--}}
            {{--console.log("aa");--}}
            {{--data["datasets"][0]["data"][0] = 50;--}}
            {{--data["datasets"][0]["data"][1] = 50;--}}

            {{--new Chart(ctx,{--}}
                {{--type: 'pie',--}}
                {{--data: data--}}
            {{--});--}}

        {{--});--}}

    {{--</script>--}}


@stop