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
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <div class="fill" style="background-image:url('{{ URL::asset('images/1.jpg') }}');"></div>
            <div class="carousel-caption">
                <h2>Tweets: Good or Bad?</h2>
            </div>
        </div>
        <div class="item">
            <div class="fill" style="background-image:url('{{ URL::asset('images/2.jpg') }}');"></div>
            <div class="carousel-caption">
                <h2>Which is better?</h2>
            </div>
        </div>
        <div class="item">
            <div class="fill" style="background-image:url('{{ URL::asset('images/3.jpg') }}');"></div>
            <div class="carousel-caption">
                <h2>Checkkkkkk up on your favourite topics</h2>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>


<div class="container">

    <div class="row">

        {{--<div class="col-sm-12">--}}
        {{--<div class="jumbotron">--}}
        {{--<h1>Twitter analytics made easier!</h1>--}}
        {{--<p>Offering you analytics to filter positive, and negative tweets</p>--}}
        {{--</div>--}}
        {{--</div>--}}

        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome to Tweet-U : <small>Comprehensive twitter analytics</small>
            </h1>
        </div>

        <div class="col-sm-12">

            <div class="col-sm-4 hp-container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-twitter"></i>Analyze topics</h4>
                    </div>
                    <div class="panel-body">
                        <p>Analyze a topic of your choice, be it a trend, a product or anything really.</p>

                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <a href="tweetAnalytics" class="btn btn-default btn-full-width">Analyze Topic</a>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

            <div class="col-sm-4 hp-container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-user"></i>Analyze Accounts</h4>
                    </div>
                    <div class="panel-body">
                        <p>Analyze a twitter account. Want to see how your favorite celebrity is received by the public?
                            give it a try!</p>

                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <a href="#" class="btn btn-default btn-full-width">Analyze Account</a>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


            <div class="col-sm-4 hp-container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compress"></i>Compare topics</h4>
                    </div>
                    <div class="panel-body">
                        <p>Analyze two topics simultaneously, and compare the public perception of the two. Good for
                            comparing two topics.</p>

                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <a href="#" class="btn btn-default btn-full-width">Compare Topics</a>
                    </div>
                </div>
            </div>


            {{--<div class="col-sm-4 hp-container">--}}
            {{--<div class="col-sm-12 hp-panel">--}}
            {{--<div class="col-sm-12">--}}
            {{--<h3>Analyze topics</h3>--}}
            {{--</div>--}}
            {{--<div class="col-sm-12">--}}
            {{--<hr>--}}
            {{--</div>--}}
            {{--<div class="col-sm-12">--}}
            {{--<p>Analyze two topics simultaneously, and compare the public perception of the two. Good for comparing two topics</p>--}}
            {{--</div>--}}
            {{--<div class="col-sm-12">--}}
            {{--<hr>--}}
            {{--</div>--}}
            {{--<div class="col-sm-12">--}}
            {{--<a class="btn btn-primary btn-full-width">Compare Topics</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}


        </div>

    </div>

</div>
@stop