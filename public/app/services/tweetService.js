/**
 * Created by ACer on 10/28/2016.
 */

app.service("getTweets", function ($http, $q) {

    var getTweets = function (search, maxID, recent) {

        var canceller = $q.defer();

        var cancelTweet = function (reason) {
            canceller.resolve(reason);
        };

        var tweet = $http.get(baseUrl + "get_tweets", {
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