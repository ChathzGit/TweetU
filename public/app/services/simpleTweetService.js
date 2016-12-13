/**
 * Created by ACer on 11/19/2016.
 */

app.service("simpleGetTweets", function($http, $q) {

    var getTweets = function (search, maxID, recent) {

        var canceller = $q.defer();

        var cancelTweet = function (reason) {
            canceller.resolve(reason);
        };

        var tweet = $http.get("get_compare_tweets", {
            params: {search: search, maxID: maxID, recent: recent},
            timeout: canceller.promise
        }).then(function (response) {
            return response.data;
        });

        return {
            tweet: tweet,
            cancelTweet: cancelTweet
        };
    };

    return {
        getTweets: getTweets
    };

});