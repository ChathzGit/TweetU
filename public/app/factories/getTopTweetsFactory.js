/**
 * Created by ACer on 10/28/2016.
 *
 * From this factory main purpose is to set the positive or negative top tweets nd display them
 * and show the user how those tweets have been calculated
 *
 * From this factory it's not directly getting the negative or positive tweet by the response coming from twin word,
 * in here only getting a result has over 0.1 which is positive under 0.1 which is negative
 * and an ratio directly equals to 0.1 or -0.1 which check as directly negatives or directly positives.
 *
 * To show how analytical part is done calling "settingTopTweetAnalyzer" service which handle the displaying that part
 *
 * Error handling done for network failures and display the error model
 */

app.factory('getTops', function (getTweets, checkPosNeg, settingTopTweetAnalyzer, settingError) {

    function setTops(search, countPos, countNeg, $scope) {

        var tweet = getTweets.getTweets(search, maxIDPopular, 0);
        tweet.tweet.then(function (response) {
            if (response["Error"] == undefined || response.length == 1) {
                for (var i = 0; i < response.length - 1; i++) {

                    (function (response, i) {

                        var posNeg = checkPosNeg.getType(response[i]["text"]);
                        posNeg.type.then(function (result) {

                            if($scope.loading){
                                $scope.loading = false;
                            }

                            if (result["type"] == "positive" && (result["score"] >= 0.1 || result["ratio"] == 1) && !$scope.positives.some(function(el) { return el.text === response[i]["text"]; })) {
                                if (countPos > 0) {

                                    countPos--;

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

                                    var posLength = $scope.positives.length;
                                    (function (lastIndex, result) {
                                        setTimeout(settingTopTweetAnalyzer.settingAnalyzer($scope.positives, lastIndex, result), 0);
                                    })(posLength - 1, result);
                                }
                            } else if (result["type"] == "negative" && (result["score"] <= -0.1 || result["ratio"] == -1) && !$scope.negatives.some(function(el) { return el.text === response[i]["text"]; })) {
                                if (countNeg > 0) {

                                    countNeg--;

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


                        }, function errorCallback() {
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

                    for (var posNegRequestsCount1 = 0; posNegRequestsCount1 < GetTopTweetPosNegRequests.length; posNegRequestsCount1++) {
                        GetTopTweetPosNegRequests[posNegRequestsCount1].cancelChecker("New Request");
                    }
                    GetTopTweetPosNegRequests.length = 0;

                    for (var getTopTweetsRequestsCount1 = 0; getTopTweetsRequestsCount1 < GetTopTweetsRequests.length; getTopTweetsRequestsCount1++) {
                        GetTopTweetsRequests[getTopTweetsRequestsCount1].cancelTweet("New Request");
                    }
                    GetTopTweetsRequests.length = 0;

                    for (var posNegRequestsCount2 = 0; posNegRequestsCount2 < GetTweetPosNegRequests.length; posNegRequestsCount2++) {
                        GetTweetPosNegRequests[posNegRequestsCount2].cancelChecker("New Request");
                    }
                    GetTweetPosNegRequests.length = 0;

                    for (var getTopTweetsRequestsCount2 = 0; getTopTweetsRequestsCount2 < GetTweetRequests.length; getTopTweetsRequestsCount2++) {
                        GetTweetRequests[getTopTweetsRequestsCount2].cancelTweet("New Request");
                    }
                    GetTweetRequests.length = 0;

                    for (var getMapCallsCount = 0; getMapCallsCount < GetMapCalls.length; getMapCallsCount++) {
                        GetMapCalls[getMapCallsCount].cancelMapping("New Request");
                    }
                    GetMapCalls.length = 0;
                    insideMapHttp = 0;

                    settingError.networkError();
                }
            }
        }, function errorCallback() {
            if(maxIDSearch == -1) {

                if($scope.loading){
                    $scope.loading = false;
                }

                for (var posNegRequestsCount1 = 0; posNegRequestsCount1 < GetTopTweetPosNegRequests.length; posNegRequestsCount1++) {
                    GetTopTweetPosNegRequests[posNegRequestsCount1].cancelChecker("New Request");
                }
                GetTopTweetPosNegRequests.length = 0;

                for (var getTopTweetsRequestsCount1 = 0; getTopTweetsRequestsCount1 < GetTopTweetsRequests.length; getTopTweetsRequestsCount1++) {
                    GetTopTweetsRequests[getTopTweetsRequestsCount1].cancelTweet("New Request");
                }
                GetTopTweetsRequests.length = 0;

                for (var posNegRequestsCount2 = 0; posNegRequestsCount2 < GetTweetPosNegRequests.length; posNegRequestsCount2++) {
                    GetTweetPosNegRequests[posNegRequestsCount2].cancelChecker("New Request");
                }
                GetTweetPosNegRequests.length = 0;

                for (var getTopTweetsRequestsCount2 = 0; getTopTweetsRequestsCount2 < GetTweetRequests.length; getTopTweetsRequestsCount2++) {
                    GetTweetRequests[getTopTweetsRequestsCount2].cancelTweet("New Request");
                }
                GetTweetRequests.length = 0;

                for (var getMapCallsCount = 0; getMapCallsCount < GetMapCalls.length; getMapCallsCount++) {
                    GetMapCalls[getMapCallsCount].cancelMapping("New Request");
                }
                GetMapCalls.length = 0;
                insideMapHttp = 0;

                settingError.networkError();
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
