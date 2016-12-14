{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is tweet comparison page
--
-- Modified by Chathra Seneviratne
--}}

@extends('pages.index')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row m-t-20 well bg-opc-65" style="text-align: center;">
                <h2 class="page-header">
                    :About the Site:
                </h2>
                <br>
                <p class="text-grey">This site enables you to gather and analyze information from the Twitter Sphere.</p>
                <div class="row">

                    <div class="container">

                        <div class="col-sm-12">

                            <div class="col-sm-12 p-0">
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

                                                    <p class="text-grey">Analyze a topic of your choice. Tweet-U will read through
                                                        the related tweets
                                                        about the topic, and display a report of its reception.
                                                    </p>

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

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


                            <div class="col-sm-12 p-0">
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

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="row m-t-20 well bg-opc-65" style="text-align: center;">
                <h2 class="page-header">
                    :About Us:
                </h2>
                <div class="row">
                    <div class="container">
                        <div class="col-sm-12">
                            <div class="col-sm-6" style="text-align: center">
                                <img class="img-circle img-responsive img-hp-thumb" style="width: 100px; height:100px" src="{{ URL::asset('images/aboutimages/sahan.jpg') }}"/>
                                <h3>Sahan Munasinghe</h3>
                                <p class="text-grey">An undergrad developer, currently doing a Bsc. In information Technology at S.L.I.I.T</p>
                            </div>
                            <div class="col-sm-6" style="text-align: center">
                                <img class="img-circle img-responsive img-hp-thumb" style="width: 100px; height:100px" src="{{ URL::asset('images/aboutimages/kasun.jpg') }}"/>
                                <h3>Kasun Kodithuwakku</h3>
                                <p class="text-grey">Eat. Sleep. Code. Repeat.</p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6" style="text-align: center">
                                <img class="img-circle img-responsive img-hp-thumb" style="width: 100px; height:100px" src="{{ URL::asset('images/aboutimages/dhanuka.jpg') }}"/>
                                <h3>Dhanuka Anjana</h3>
                                <p class="text-grey">I love coding</p>
                            </div>
                            <div class="col-sm-6" style="text-align: center">
                                <img class="img-circle img-responsive img-hp-thumb" style="width: 100px; height:100px" src="{{ URL::asset('images/aboutimages/chathra.jpg') }}"/>
                                <h3>Chathra Senevirathne</h3>
                                <p class="text-grey">Life is short. So code!</p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="text-align: center">
                                <img class="img-circle img-responsive img-hp-thumb" style="width: 100px; height:100px" src="{{ URL::asset('images/aboutimages/nimanthika.jpg') }}"/>
                                <h3>Nimanthika Wickramasinghe</h3>
                                <p class="text-grey">Java Cook</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop