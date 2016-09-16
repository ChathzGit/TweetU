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
        </div>
        <!-- ---------------- Pie Chart Section End ------------------------------------------------------------------------------------------- -->

        <div class="col-sm-12">
            <hr>
        </div>








        <!-- -------------------- Good Bad Tweets Section Start --------------------------------------------------------------- -->
        <div class="col-sm-12 well">
            <h4>Top 5 Good & Bad:</h4>

            <div class="col-sm-12">

                <div class="col-sm-6">


                </div>

                <div class="col-sm-6">

                </div>
            </div>
        </div>
        <!-- ----------------------- Good Bad Tweets Section End ---------------------------------------------------------------------------------------- -->





    </div>



@stop