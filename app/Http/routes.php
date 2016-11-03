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


/*
 * Admin routes
 */
Route::get('admin_home', 'AdminHomepageController@index');

//not using for now
//Route::get('get_pos_neg', 'SentimentController@getPositiveNegative');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('get_profiles','ProfileController@getProfiles');
Route::get('get_profiles_view','ProfileController@index');


/*
 * User accounts routes
 */
Route::get('register_user', 'UserAccountController@index');
Route::post('save_user', 'UserAccountController@saveUser');
Route::get('user_accounts', 'UserAccountController@loadUserPage');
Route::get('load_all_users','UserAccountController@getAllUsers');

/*
 * Login interface routes
 */
Route::get('login_page', 'LoginController@index');
Route::post('check_credentials', 'LoginController@checkCredentials');

/*
 * Search log routes
 */
Route::get('getAllSearchLogs', 'SearchLogController@getAllSearchLogs');
Route::get('getPercentageChange', 'SearchLogController@getPercentageChanges');
Route::post('getAllSearchLogCount', 'SearchLogController@getAllSearchLogCount');
Route::get('getSearchLogs', 'SearchLogController@getSearchLogs');
Route::get('SearchLogTestData', 'SearchLogController@loadSearchDataTestDataInterface');
Route::get('loadUsageStatistics', 'SearchLogController@loadUsageStatisticsPage');
Route::post('saveSearchLog', 'SearchLogController@saveSearchLog');

