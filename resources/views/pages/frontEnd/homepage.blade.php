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
        <!-- Header Carousel -->
{{--<header id="myCarousel" class="carousel slide">--}}
{{--<!-- Indicators -->--}}
{{--<ol class="carousel-indicators">--}}
{{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>--}}
{{--<li data-target="#myCarousel" data-slide-to="1"></li>--}}
{{--<li data-target="#myCarousel" data-slide-to="2"></li>--}}
{{--</ol>--}}

{{--<!-- Wrapper for slides -->--}}
{{--<div class="carousel-inner">--}}
{{--<div class="item active">--}}
{{--<div class="fill" style="background-image:url('{{ URL::asset('images/1.jpg') }}');"></div>--}}
{{--<div class="carousel-caption">--}}
{{--<h2>Tweets: Good or Bad?</h2>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--<div class="fill" style="background-image:url('{{ URL::asset('images/2.jpg') }}');"></div>--}}
{{--<div class="carousel-caption">--}}
{{--<h2>Which is better?</h2>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--<div class="fill" style="background-image:url('{{ URL::asset('images/3.jpg') }}');"></div>--}}
{{--<div class="carousel-caption">--}}
{{--<h2>Check up on your favourite topics</h2>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<!-- Controls -->--}}
{{--<a class="left carousel-control" href="#myCarousel" data-slide="prev">--}}
{{--<span class="icon-prev"></span>--}}
{{--</a>--}}
{{--<a class="right carousel-control" href="#myCarousel" data-slide="next">--}}
{{--<span class="icon-next"></span>--}}
{{--</a>--}}
{{--</header>--}}


<div class="container">

    <div class="row">

        {{--<div class="col-sm-12">--}}
        {{--<div class="jumbotron">--}}
        {{--<h1>Twitter analytics made easier!</h1>--}}
        {{--<p>Offering you analytics to filter positive, and negative tweets</p>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-lg-12">--}}
        <div class="jumbotron text-center">
            <h1 class="page-header">
                Welcome to Tweet-U
            </h1>

            <h2>
                <small>Comprehensive twitter analytics</small>
            </h2>
        </div>


        <div class="col-sm-12 text-center m-b-20">
            <hr>
            <h2>Services</h2>
        </div>


        <div class="col-sm-12">

            <div class="col-sm-6 hp-container">
                <div class="panel panel-default">

                    <div class="panel-body text-center">

                        <div class="col-sm-12 text-center">
                            <div class="col-sm-4 col-xs-12">
                                <img class="img img-responsive img-hp-thumb" src="{{ URL::asset('images/hpageimg/atopics.png') }}">
                            </div>
                            <div class="col-sm-8">
                                <h4>
                                    Analyze topics
                                </h4>

                                <p class="text-grey">Analyze a topic of your choice, be it a trend, a product or anything
                                    really.</p>


                                <a href="tweetAnalytics" class="btn btn-twitter-custom btn-full-width btn-side-padding">Analyze Topic</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


            <div class="col-sm-6 hp-container">
                <div class="panel panel-default">

                    <div class="panel-body text-center">

                        <div class="col-sm-12 text-center">
                            <div class="col-sm-4 col-xs-12">
                                <img class="img img-responsive img-hp-thumb" src="{{ URL::asset('images/hpageimg/aaccounts.png') }}">
                            </div>
                            <div class="col-sm-8">
                                <h4>
                                    Analyze Accounts
                                </h4>

                                <p class="text-grey">Analyze a twitter account. Want to see how your favorite celebrity is
                                    received by the public?
                                    give it a try!</p>


                                <a href="get_profiles_view" class="btn btn-twitter-custom btn-full-width btn-side-padding">Analyze Accounts</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>


            <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



            <div class="col-sm-6 hp-container">
                <div class="panel panel-default">

                    <div class="panel-body text-center">

                        <div class="col-sm-12 text-center">
                            <div class="col-sm-4 col-xs-12">
                                <img class="img img-responsive img-hp-thumb" src="{{ URL::asset('images/hpageimg/ctopics.png') }}">
                            </div>
                            <div class="col-sm-8">
                                <h4>
                                    Compare Topics
                                </h4>

                                <p class="text-grey">Analyze two topics simultaneously, and compare the public perception of the
                                    two.</p>


                                <a href="comparison_view" class="btn btn-twitter-custom btn-full-width btn-side-padding">Compare Topics</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>


            <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



            <div class="col-sm-6 hp-container">
                <div class="panel panel-default">

                    <div class="panel-body text-center">

                        <div class="col-sm-12 text-center">
                            <div class="col-sm-4 col-xs-12">
                                <img class="img img-responsive img-hp-thumb" src="{{ URL::asset('images/hpageimg/caccounts.png') }}">
                            </div>
                            <div class="col-sm-8">
                                <h4>
                                    Compare Accounts
                                </h4>

                                <p class="text-grey">Analyze two accounts simultaneously, and compare the public perception of
                                    the two. Good for
                                    comparing two people.</p>


                                <a href="viewProfileController" class="btn btn-twitter-custom btn-full-width btn-side-padding">Compare Accounts</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>


    </div>

</div>
@stop