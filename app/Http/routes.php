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

Route::get('/', 'HomePageController@index');

Route::get('TweetAnalyzePage', 'WelcomeController@index');

Route::get('home', 'HomePageController@index');

Route::get('tweetAnalytics', 'TweetAnalyticsController@index');

Route::get('get_tweets', 'SentimentController@getTweets');

Route::get('admin_home', 'AdminHomepageController@index');

//not using for now
//Route::get('get_pos_neg', 'SentimentController@getPositiveNegative');

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);

Route::get('get_profiles','ProfileController@getProfiles');

Route::get('get_profiles_view','ProfileController@index');

Route::get('get_selected_profile','ProfileController@getSelectedProfileInfo');

Route::get('getProfileTweets','ProfileController@getProfileTweets');

Route::get('viewProfileController','ProfileController@viewProfileCompair');

Route::get('getTweetInfo','ProfileController@getProfileTweetsInfo');

Route::get('getUserLocation','ProfileController@GetUserLocations');