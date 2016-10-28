/**
 * Created by ACer on 10/28/2016.
 */


app.factory('getTops', function (getTweets, checkPosNeg) {

    function setTops(search, countPos, countNeg, $scope) {

        var tweet = getTweets.getTweets(search, maxIDPopular, 0);
        tweet.tweet.then(function (response) {
            if (response["Error"] == undefined) {
                for (var i = 0; i < response.length - 1; i++) {

                    (function (response, i) {

                        var posNeg = checkPosNeg.getType(response[i]["text"]);
                        posNeg.type.then(function (result) {

                            if ($scope.loading) {
                                $scope.loading = false;
                            }

                            if (result["type"] == "positive") {
                                if (countPos > 0) {
                                    $scope.positives.push({
                                        text: response[i]["text"],
                                        retweet: response[i]["retweet"],
                                        user: response[i]["user"]
                                    });
                                    countPos--;
                                }
                            } else if (result["type"] == "negative") {
                                if (countNeg > 0) {
                                    $scope.negatives.push({
                                        text: response[i]["text"],
                                        retweet: response[i]["retweet"],
                                        user: response[i]["user"]
                                    });
                                    countNeg--;
                                }
                            }

                            if (i == response.length - 2 && (countNeg > 0 || countPos > 0)) {
                                return setTops(search, countPos, countNeg, $scope);
                            } else if (countNeg == 0 && countPos == 0) {

                                for (var posNegRequestsCount = 0; posNegRequestsCount < GetTopTweetPosNegRequests.length; posNegRequestsCount++) {
                                    GetTopTweetPosNegRequests[posNegRequestsCount].cancelChecker("Top 5 completed");
                                }
                                GetTopTweetPosNegRequests.length = 0;

                                for (var getTopTweetsRequestsCount = 0; getTopTweetsRequestsCount < GetTopTweetsRequests.length; getTopTweetsRequestsCount++) {
                                    GetTopTweetsRequests[getTopTweetsRequestsCount].cancelTweet("Top 5 completed");
                                }
                                GetTopTweetsRequests.length = 0;
                            }
                        });

                        GetTopTweetPosNegRequests[GetTopTweetPosNegRequests.length] = posNeg;
                    })(response, i);
                }
            }
        });

        GetTopTweetsRequests[GetTopTweetsRequests.length] = tweet;
    }

    return {
        setTops: function (search, countPos, countNeg, $scope) {
            return setTops(search, countPos, countNeg, $scope);
        }
    }
});
