<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('homePage', 'HomePageController@index');
Route::get('tweetAnalytics', 'TweetAnalyticsController@index');

Route::get('get_tweets', 'SentimentController@getTweets');

//not using for now
//Route::get('get_pos_neg', 'SentimentController@getPositiveNegative');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
