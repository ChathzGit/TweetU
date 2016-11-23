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


<div class="container-fluid">

    <div class="row">

        {{--<div class="col-sm-12">--}}
        {{--<div class="jumbotron">--}}
        {{--<h1>Twitter analytics made easier!</h1>--}}
        {{--<p>Offering you analytics to filter positive, and negative tweets</p>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-lg-12">--}}
        <div class="jumbotron hp-jumbo text-center bg-opc-5">
            <div class="container hp-jumbo-in-jumbo">
                <h1 class="page-header">
                    Welcome to Tweet-U
                </h1>

                <h2 class="text-grey">
                    :Comprehensive twitter analytics:
                </h2>


                <h1>
                    <small class="text-grey">
                        Search - Analyze - Compare
                    </small>

                </h1>
                <div class="col-sm-12">
                    <hr>
                    <div class="col-sm-4"></div>

                    <a href="tweetAnalytics">
                        <div class="col-sm-1 col-xs-3">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/atopics.png') }}">
                        </div>
                    </a>


                    <a href="get_profiles_view">
                        <div class="col-sm-1 col-xs-3">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/aaccounts.png') }}">
                        </div>
                    </a>


                    <a href="comparison_view">
                        <div class="col-sm-1 col-xs-3">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/ctopics.png') }}">
                        </div>
                    </a>

                    <a href="viewProfileController">
                        <div class="col-sm-1 col-xs-3">
                            <img class="img img-responsive img-hp-thumb"
                                 src="{{ URL::asset('images/hpageimg/caccounts.png') }}">
                        </div>
                    </a>


                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="container">

            <div class="col-sm-12 text-center m-b-20">

                <h2>Services</h2>

                <h3>
                    <small class="text-grey">
                        These are the services provided by Tweet-U. None of the services require a user
                        account, so feel free to use any of these without hesitation.
                    </small>
                </h3>
            </div>


            <div class="col-sm-12">

                <div class="col-sm-6 hp-container">
                    <div class="panel panel-default bg-opc-65">

                        <div class="panel-body text-center ">

                            <div class="col-sm-12 text-center">
                                <div class="col-sm-4 col-xs-12">
                                    <img class="img img-responsive img-hp-thumb"
                                         src="{{ URL::asset('images/hpageimg/atopics.png') }}">
                                </div>
                                <div class="col-sm-8">
                                    <h4>
                                        Analyze topics
                                    </h4>

                                    <p class="text-grey">Analyze a topic of your choice. Tweet-U will read through the related tweets
                                        about the topic, and display a report of its reception.
                                    </p>


                                    <a href="tweetAnalytics"
                                       class="btn btn-twitter-custom btn-full-width btn-side-padding">Analyze
                                        Topic</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


                <div class="col-sm-6 hp-container">
                    <div class="panel panel-default bg-opc-65">

                        <div class="panel-body text-center">

                            <div class="col-sm-12 text-center">
                                <div class="col-sm-4 col-xs-12">
                                    <img class="img img-responsive img-hp-thumb"
                                         src="{{ URL::asset('images/hpageimg/aaccounts.png') }}">
                                </div>
                                <div class="col-sm-8">
                                    <h4>
                                        Analyze Accounts
                                    </h4>

                                    <p class="text-grey">Analyze a twitter account. Want to see how your favorite
                                        celebrity
                                        is
                                        received by the public?
                                        give it a try!</p>


                                    <a href="get_profiles_view"
                                       class="btn btn-twitter-custom btn-full-width btn-side-padding">Analyze
                                        Accounts</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


                <div class="col-sm-6 hp-container">
                    <div class="panel panel-default bg-opc-65">

                        <div class="panel-body text-center">

                            <div class="col-sm-12 text-center">
                                <div class="col-sm-4 col-xs-12">
                                    <img class="img img-responsive img-hp-thumb"
                                         src="{{ URL::asset('images/hpageimg/ctopics.png') }}">
                                </div>
                                <div class="col-sm-8">
                                    <h4>
                                        Compare Topics
                                    </h4>

                                    <p class="text-grey">Analyze two topics simultaneously, and compare the public
                                        perception of the
                                        two.</p>


                                    <a href="comparison_view"
                                       class="btn btn-twitter-custom btn-full-width btn-side-padding">Compare Topics</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


                <div class="col-sm-6 hp-container">
                    <div class="panel panel-default bg-opc-65">

                        <div class="panel-body text-center">

                            <div class="col-sm-12 text-center">
                                <div class="col-sm-4 col-xs-12">
                                    <img class="img img-responsive img-hp-thumb"
                                         src="{{ URL::asset('images/hpageimg/caccounts.png') }}">
                                </div>
                                <div class="col-sm-8">
                                    <h4>
                                        Compare Accounts
                                    </h4>

                                    <p class="text-grey">Analyze two accounts simultaneously, and compare the public
                                        perception of
                                        the two. Good for
                                        comparing two people.</p>


                                    <a href="viewProfileController"
                                       class="btn btn-twitter-custom btn-full-width btn-side-padding">Compare
                                        Accounts</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@stop