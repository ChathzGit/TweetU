{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the master page to where all other blade files are loaded into
--
--}}

<!DOCTYPE html>
<html lang="en" ng-app="tweetU">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tweet-U</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/modern-business.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">

    {{--Toaster css--}}
    <link href="{{ asset('/css/toaster.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ URL::asset('resources/assets/font-awesome/css/modern-business.css') }}" rel="stylesheet">--}}

    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery.js') }}"></script>

    <!-- Angular -->
    {{--<script src="{{ asset('/js/angular.min.js') }}"></script>--}}
    <script src="{{ asset('/js/angular.min.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body ng-controller="mainCtrl">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home">Tweet-U</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="">About</a>
                </li>
                <li>
                    <a href="">Services</a>
                </li>
                <li>
                    <a href="">Contact</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        {{--<li>--}}
                            {{--<a href="portfolio-1-col.html">1 Column Portfolio</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="portfolio-2-col.html">2 Column Portfolio</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="portfolio-3-col.html">3 Column Portfolio</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="portfolio-4-col.html">4 Column Portfolio</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="portfolio-item.html">Single Portfolio Item</a>--}}
                        {{--</li>--}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        {{--<li>--}}
                            {{--<a href="blog-home-1.html">Blog Home 1</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="blog-home-2.html">Blog Home 2</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="blog-post.html">Blog Post</a>--}}
                        {{--</li>--}}
                    </ul>
                </li>
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li>--}}
                            {{--<a href="full-width.html">Full Width Page</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="sidebar.html">Sidebar Page</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="faq.html">FAQ</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="404.html">404</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="pricing.html">Pricing Table</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li>
                    <a href="register_user">Register</a>
                </li>

                <li>
                    <a href="login_page">Log In</a>
                </li>

                <li>
                    <a href="admin_home"><span class="c-red">Admin pages</span></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>



<!-- Page Content -->

<toaster-container
        toaster-options="{'time-out': 3000, 'close-button':true, 'animation-class': 'toast-top-right'}"></toaster-container>
    @yield('content')


<!-- Footer -->
<footer>
        <div class="col-sm-12">
            <hr>
        </div>
        <div class="col-sm-12 text-center">
            <p id="aaaa">Copyright &copy; Tweet-U 2016</p>
        </div>
</footer>






<!-- Tweet Sentiment JS -->
<script src="{{ asset('/js/twitter-sentiment.js') }}"></script>

{{-- Angular controllers --}}
<script src="{{ asset('/app/app.js') }}"></script>
<script src="{{ asset('/app/mainCtrl.js') }}"></script>

{{-- Angular controllers --}}
<script src="{{ asset('/app/controllers/userAccountCtrl.js') }}"></script>
<script src="{{ asset('/app/controllers/positiveNegativeCtrl.js') }}"></script>
<script src="{{ asset('/app/controllers/logInCtrl.js') }}"></script>

{{-- Angular services --}}
<script src="{{ asset('/app/services/userAccountService.js') }}"></script>
<script src="{{ asset('/app/services/loginService.js') }}"></script>
<script src="{{ asset('/app/services/positiveNegativeService.js') }}"></script>
<script src="{{ asset('/app/services/tweetService.js') }}"></script>

{{-- Angular directives --}}
<script src="{{ asset('/app/directives/topTweetDirective.js') }}"></script>

{{-- Angular factories --}}
<script src="{{ asset('/app/factories/getPositiveNegativeFactory.js') }}"></script>
<script src="{{ asset('/app/factories/getTopTweetsFactory.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<!-- Chart.js -->
<script src="{{ URL::asset('js/Chart.js') }}"></script>

<!-- angular-chart.js -->
<script src="{{ URL::asset('js/angular-chart.js') }}"></script>

{{--Toaster js--}}
<script src="{{ asset('/js/angular-animate.min.js') }}"></script>
<script src="{{ asset('/js/toaster.js') }}"></script>





</body>

</html>