/**
 * Created by ACer on 10/28/2016.
 */

app.factory('getTops', function (getTweets, checkPosNeg, settingTopTweetAnalyzer, settingError) {

    function setTops(search, countPos, countNeg, $scope) {

        var tweet = getTweets.getTweets(search, maxIDPopular, 0);
        tweet.tweet.then(function (response) {
            if (response["Error"] == undefined) {
                for (var i = 0; i < response.length - 1; i++) {

                    (function (response, i) {

                        var posNeg = checkPosNeg.getType(response[i]["text"]);
                        posNeg.type.then(function (result) {

                            if($scope.loading){
                                $scope.loading = false;
                            }

                            if (result["type"] == "positive" && (result["score"] >= 0.1 || result["ratio"] == 1) && !$scope.positives.some(function(el) { return el.text === response[i]["text"]; })) {
                                if (countPos > 0) {

                                    currentTopTweetResponse["pos"][countPos] = {
                                        text: response[i]["text"].split(" "),
                                        result: result
                                    };

                                    $scope.justTweets["pos"][countPos] = true;
                                    $scope.topAnalyzer["pos"][countPos] = false;

                                    $scope.positives.push({
                                        text: response[i]["text"],
                                        retweet: response[i]["retweet"],
                                        user: response[i]["user"],
                                        number: countPos,
                                        analyzed: [],
                                        total: 0
                                    });
                                    countPos--;

                                    var posLength = $scope.positives.length;
                                    (function (lastIndex, result) {
                                        setTimeout(settingTopTweetAnalyzer.settingAnalyzer($scope.positives, lastIndex, result), 0);
                                    })(posLength - 1, result);
                                }
                            } else if (result["type"] == "negative" && (result["score"] <= -0.1 || result["ratio"] == -1) && !$scope.negatives.some(function(el) { return el.text === response[i]["text"]; })) {
                                if (countNeg > 0) {

                                    currentTopTweetResponse["neg"][countNeg] = {
                                        text: response[i]["text"].split(" "),
                                        result: result
                                    };

                                    $scope.justTweets["neg"][countNeg] = true;
                                    $scope.topAnalyzer["neg"][countNeg] = false;

                                    $scope.negatives.push({
                                        text: response[i]["text"],
                                        retweet: response[i]["retweet"],
                                        user: response[i]["user"],
                                        number: countNeg,
                                        analyzed: [],
                                        total: 0
                                    });
                                    countNeg--;

                                    var negLength = $scope.negatives.length;
                                    (function (lastIndex, result) {
                                        setTimeout(settingTopTweetAnalyzer.settingAnalyzer($scope.negatives, lastIndex, result), 0);
                                    })(negLength - 1, result);
                                }
                            }

                            if (i == response.length - 2 && (countNeg > 0 || countPos > 0)) {
                                maxIDPopular = response[response.length - 1];
                                return setTops(search, countPos, countNeg, $scope);
                            } else if (countNeg == 0 && countPos == 0) {

                                for(var posNegRequestsCount = 0; posNegRequestsCount < GetTopTweetPosNegRequests.length; posNegRequestsCount++){
                                    GetTopTweetPosNegRequests[posNegRequestsCount].cancelChecker("Top 5 completed");
                                }
                                GetTopTweetPosNegRequests.length = 0;

                                for(var getTopTweetsRequestsCount = 0; getTopTweetsRequestsCount < GetTopTweetsRequests.length; getTopTweetsRequestsCount++){
                                    GetTopTweetsRequests[getTopTweetsRequestsCount].cancelTweet("Top 5 completed");
                                }
                                GetTopTweetsRequests.length = 0;
                            }
                        });

                        GetTopTweetPosNegRequests[GetTopTweetPosNegRequests.length] = posNeg;
                    })(response, i);
                }
            } else {
                if(maxIDPopular == -1) {

                    if($scope.loading){
                        $scope.loading = false;
                    }

                    settingError.networkError();
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
