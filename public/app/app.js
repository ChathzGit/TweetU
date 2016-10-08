/**
 * Created by Sahan on 10/8/2016.
 */
var app = angular.module('tweetU',
    [
        'chart.js',
        'toaster'
    ],

    ['$interpolateProvider',

        function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        }])

    .constant('API_URL', 'http://localhost:8080/TweetU/public/');


app.controller('posNegSentiment', function ($scope, getPosNeg, getTops, $window) {

    $scope.loading = false;

    $scope.labels = ["Negative", "Positive"];
    $scope.data = [50, 50];
    $scope.positives = [];
    $scope.negatives = [];

    $scope.getInfo = function () {

        $scope.loading = true;

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

        //getting to pie chart...
        // 20 change how much time you need from twitter... 1 ~ (aaaasannawa)100i.. sometimes under 40 but taking as near 100 :D
        getPosNeg.setPosNeg($scope.search, 2, $scope);

        //getting top good bad, tweets
        var topResultCount = 5; // change here how much you need to get... hehe mama ganne 5i :D
        $scope.positives.length = 0;
        $scope.negatives.length = 0;
        getTops.setTops($scope.search, topResultCount, topResultCount, $scope);
    };

    $scope.newSearch = function (search) {
        $scope.search = search;
        $window.scrollTo(0, 0);
    }
});

app.service("getTweets", function ($http, $q) {

    var getTweets = function (search, maxID, recent) {

        var canceller = $q.defer();

        var cancelTweet = function (reason) {
            canceller.resolve(reason);
        };

        var tweet = $http.get(baseUrl + "/public/get_tweets", {
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

app.service("checkPosNeg", function ($http, $q) {

    var getType = function (search) {

        var canceller = $q.defer();

        var cancelChecker = function (reason) {
            canceller.resolve(reason);
        };

        var type = $http.get("https://twinword-sentiment-analysis.p.mashape.com/analyze/", {
            headers: {
                'X-Mashape-Key': 'ojF8QuQu1ZmshWjxUrOGDmm5iuV2p1S2cpwjsnmHgOkkAsMmzO',
                'Accept': 'application/json'
            },
            params: {text: search},
            timeout: canceller.promise
        }).then(function (response) {
            return response.data;
        });

        return {
            type: type,
            cancelChecker: cancelChecker
        };
    };

    return {
        getType: getType
    };

});

app.factory('getPosNeg', function (getTweets, checkPosNeg) {
    function setPosNeg(search, count, $scope) {
        if (count > 0) {

            var tweet = getTweets.getTweets(search, maxIDPopular, 1);
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
                                    pos += 1;
                                } else if (result["type"] == "negative") {
                                    neg += 1;
                                }

                                $scope.data[0] = Math.round(100 * pos / (pos + neg));
                                $scope.data[1] = Math.round(100 * neg / (pos + neg));

                                if (i == Math.round(response.length * 20 / 100)) {
                                    maxIDSearch = response[response.length - 1];
                                    return setPosNeg(search, count - 1, $scope);
                                }

                            });

                            GetTweetPosNegRequests[GetTweetPosNegRequests.length] = posNeg;

                        })(response, i);
                    }
                } else {
                    console.log("Error");
                }
            });

            GetTweetRequests[GetTweetRequests.length] = tweet;

        } else {
            return;
        }
    }

    return {
        setPosNeg: function (search, count, $scope) {
            return setPosNeg(search, count, $scope);
        }
    }
});


//twitterThing.factory('getPosNeg', function($http) {
//    function setPosNeg(search, count, $scope){
//        if (count > 0) {
//            $http.get(baseUrl + "/public/get_tweets", {
//                params: {search: search, maxID: maxIDSearch, recent: true}
//            }).success(function (response) {
//
//                console.log(response.length);
//
//                if (response["Error"] == undefined) {
//                    for (var i = 0; i < response.length - 1; i++) {
//
//                        //var sentences = [];
//                        //for(var j = i; (j < response.length - 1 && j <= i + 2); j++){
//                        //    sentences[sentences.length] = response[j];
//                        //}
//                        //i += sentences.length;
//                        //
//                        //$http.get(baseUrl + "/public/get_pos_neg", {
//                        //    params : {sentences: JSON.stringify(sentences)}
//                        //}).success(function (percentages) {
//                        //    pos += percentages["positive"];
//                        //    neg += percentages["negative"];
//                        //
//                        //    $scope.positive = pos;
//                        //    $scope.negative = neg;
//                        //});
//                        (function (response, i) {
//                            $http.get("https://twinword-sentiment-analysis.p.mashape.com/analyze/", {
//                                headers: {
//                                    'X-Mashape-Key': 'ojF8QuQu1ZmshWjxUrOGDmm5iuV2p1S2cpwjsnmHgOkkAsMmzO',
//                                    'Accept': 'application/json'
//                                },
//                                params: {text: response[i]}
//                            }).success(function (result) {
//
//                                if (result["type"] == "positive") {
//                                    pos += 1;
//                                } else if (result["type"] == "negative") {
//                                    neg += 1;
//                                }
//
//                                $scope.data[0] = Math.round(100 * pos / (pos + neg));
//                                $scope.data[1] = Math.round(100 * neg / (pos + neg));
//
//                                if (i == Math.round(response.length * 20 / 100)) {
//                                    maxIDSearch = response[response.length - 1];
//                                    return setPosNeg(count - 1, $scope);
//                                }
//
//                            });
//                        })(response, i);
//                    }
//                } else {
//                    console.log("Error");
//                }
//            });
//        } else {
//            return;
//        }
//    }
//
//    return {
//        setPosNeg : function (search, count, $scope) {
//            return setPosNeg(search, count, $scope);
//        }
//    }
//});

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

app.directive('topTweet', function ($compile) {
    return {
        scope: {
            tweet: '=tweet'
        },
        controller: function ($scope, $element) {

            var ele = $compile("<div style='word-wrap: break-word'></div>")($scope);
            var currentTypingLabel = $compile("<span></span>")($scope);

            var tweetTxt = $scope.tweet.split(" ");
            var previousSpecialDetail = false;

            for (var i = 0; i < tweetTxt.length; i++) {
                if (tweetTxt[i][0] == "@" || tweetTxt[i][0] == "#") {
                    var userAccount;
                    if (tweetTxt[i][0] == "#") {

                        userAccount = [];

                        var replacingString = tweetTxt[i].replace("#", ",%.%#")

                        var hashTags = replacingString.split(",%.%");
                        for (var j = 0; j < hashTags.length; j++) {

                            var word = hashTags[j].substring(1);
                            if (/^[a-zA-Z0-9]+$/.test(word)) {
                                userAccount[j] = $compile('<span ng-click="$parent.newSearch(\'' + hashTags[j] + '\')" style="text-decoration: underline; color: blue">' + hashTags[j] + '</span>')($scope);
                            } else {
                                var lastLetterIndex = 0;
                                for (var k = 0; k < word.length; k++) {
                                    if (!(/^[a-zA-Z0-9]/.test(word[k]))) {
                                        lastLetterIndex = k;
                                        break;
                                    }
                                }

                                if (lastLetterIndex != 0) {
                                    userAccount[j] = $compile(
                                        '<span ng-click="$parent.newSearch(\'' + hashTags[j].substring(0, lastLetterIndex + 1) + '\')" style="text-decoration: underline; color: blue">' + hashTags[j].substring(0, lastLetterIndex + 1) + '</span>' +
                                        '<span>' + hashTags[j].substring(lastLetterIndex + 1) + '</span>'
                                    )($scope);
                                } else {
                                    userAccount[j] = $compile(
                                        '<span>' + hashTags[j] + '</span>'
                                    )($scope);
                                }
                            }
                        }

                    } else {
                        userAccount = $compile('<span style="color: blue; text-decoration: underline">' + tweetTxt[i] + '</span>')($scope);
                    }

                    ele.append(userAccount);
                    previousSpecialDetail = true;
                } else {
                    if (previousSpecialDetail && currentTypingLabel.text() != "") {
                        previousSpecialDetail = false;
                        ele.append(currentTypingLabel);
                        currentTypingLabel = $compile("<span></span>")($scope);
                        currentTypingLabel.text(" " + tweetTxt[i] + " ");
                    } else {
                        currentTypingLabel.text(" " + currentTypingLabel.text() + tweetTxt[i] + " ");
                    }
                }
            }

            ele.append(currentTypingLabel);
            $element.append(ele);
        }
    }
});