/**
 * Created by Sahan on 10/8/2016.
 */
var app = angular.module('tweetU',
    [
        'chart.js',
        'toaster',
        'ngCookies'
    ],

    ['$interpolateProvider',

        function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        }])

    // This will be used for the server calls
    .constant('API_URL', 'http://localhost:8080/TweetU/public/')

    /*
    * Response Codes -
    * These will be used when checking the response from the server
    * This is to minimize errors when it comes to typos, and to make things easier of one
    * of these codes were to be changed in the future.
    */
    .constant('SUCCESS', 'Success')
    .constant('ERROR', 'Error');






