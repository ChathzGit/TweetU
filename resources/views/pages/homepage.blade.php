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

    <div class="row">
        <div class="col-sm-12">

            <div class="jumbotron">


                <h1>Twitter analytics made easier!</h1>

                <p>Offering you analytics to filter positive, and negative tweets</p>
            </div>
        </div>


        <div class="col-sm-12">


            <div class="col-sm-4 hp-container">
                <div class="col-sm-12 hp-panel">
                    <div class="col-sm-12">
                        <h3>Analyze topics</h3>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <p>Analyze a topic of your choice, be it a trend, a product or anything really.</p>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-full-width">Analyze Topic</button>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 hp-container">
                <div class="col-sm-12 hp-panel">
                    <div class="col-sm-12">
                        <h3>Analyze topics</h3>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <p>Analyze a twitter account. Want to see how your favorite celebrity is received by the public? give it a try!</p>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-full-width">Analyze Account</button>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 hp-container">
                <div class="col-sm-12 hp-panel">
                    <div class="col-sm-12">
                        <h3>Analyze topics</h3>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <p>Analyze two topics simultaneously, and compare the public perception of the two. Good for comparing two topics</p>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-full-width">Compare Topics</button>
                    </div>
                </div>
            </div>




        </div>

    </div>
@stop