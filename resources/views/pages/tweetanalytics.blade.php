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


    <div class="container">

        <div class="row m-t-20 well">

            <div class="col-sm-1"></div>


            <!-- --------------------------------------------------------------------------------------------------------------- -->
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <h4>Search Criteria:</h4>
                </div>

                <div class="col-sm-11 col-xs-10">
                    <input id="search" class="form-control" type="text">
                </div>

                <div class="col-sm-1 col-xs-2">
                    <a href="" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
            </div>
            <!-- --------------------------------------------------------------------------------------------------------------- -->

            <div class="col-sm-1"></div>


        </div>

        <div class="col-sm-12">
            <hr>
        </div>


        <!-- ---------------- Pie Chart Section Start ------------------------------------------------------------------------------------------- -->
        <div class="col-sm-12 well">
            <h4>Pie Chart:</h4>

            <div class="col-sm-4"></div>

            <div class="col-sm-4">
                <canvas id="myChart" width="200" height="200"></canvas>
            </div>

            <div class="col-sm-4"></div>

        </div>
        <!-- ---------------- Pie Chart Section End ------------------------------------------------------------------------------------------- -->

        <div class="col-sm-12">
            <hr>
        </div>


        <!-- -------------------- Good Bad Tweets Section Start --------------------------------------------------------------- -->
        <div class="col-sm-12 well">
            <h4>Top 5 <strong class="c-green">Good</strong> & <strong class="c-red">Bad</strong> :</h4>

            <div class="row p-0">

                <div class="col-sm-6 col-xs-12">
                    <div class="col-xs-12 good-tweet gb-tweet">
                        <p>This is a good tweet yaaaayy!!</p>
                    </div>

                    <div class="col-xs-12 good-tweet gb-tweet">
                        <p>This is a good tweet yaaaayy!!</p>
                    </div>

                    <div class="col-xs-12 good-tweet gb-tweet">
                        <p>This is a good tweet yaaaayy!!</p>
                    </div>
                </div>

                <div class="col-xs-12 visible-xs">
                    <hr>
                </div>


                <div class="col-sm-6 col-xs-12">

                    <div class="col-xs-12 bad-tweet gb-tweet">
                        <p>This is a bad tweet boooo!!</p>
                    </div>

                    <div class="col-xs-12 bad-tweet gb-tweet">
                        <p>This is a bad tweet boooo!!</p>
                    </div>

                    <div class="col-xs-12 bad-tweet gb-tweet">
                        <p>This is a bad tweet boooo!!</p>
                    </div>

                    <div class="col-xs-12 bad-tweet gb-tweet">
                        <p>This is a bad tweet boooo!!</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ----------------------- Good Bad Tweets Section End ---------------------------------------------------------------------------------------- -->






@stop