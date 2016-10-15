var pos = 0, neg = 0, maxIDSearch = -1, maxIDPopular = -1;

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

var GetTopTweetsRequests = [];
var GetTopTweetPosNegRequests = [];

var GetTweetRequests = [];
var GetTweetPosNegRequests = [];

var currentTopTweetResponse = [];
currentTopTweetResponse["pos"] = [];
currentTopTweetResponse["neg"] = [];

var howToCheckingTweet = [];

var twitterThing = angular.module('myAppIndex', ['chart.js'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

twitterThing.controller('posNegSentiment', function($scope, getPosNeg, getTops, $window, $timeout) {

    $scope.loading = false;

    $scope.labels = ["Negative", "Positive"];
    $scope.data = [50, 50];
    $scope.positives = [];
    $scope.negatives = [];
    $scope.mouseHovered = [];

    $scope.justTweets = [];
    $scope.justTweets["pos"] = [];
    $scope.justTweets["neg"] = [];

    $scope.topAnalyzer = [];
    $scope.topAnalyzer["pos"] = [];
    $scope.topAnalyzer["neg"] = [];

    $scope.getInfo = function() {

        $scope.loading = true;

        for(var posNegRequestsCount1 = 0; posNegRequestsCount1 < GetTopTweetPosNegRequests.length; posNegRequestsCount1++){
            GetTopTweetPosNegRequests[posNegRequestsCount1].cancelChecker("New Request");
        }
        GetTopTweetPosNegRequests.length = 0;

        for(var getTopTweetsRequestsCount1 = 0; getTopTweetsRequestsCount1 < GetTopTweetsRequests.length; getTopTweetsRequestsCount1++){
            GetTopTweetsRequests[getTopTweetsRequestsCount1].cancelTweet("New Request");
        }
        GetTopTweetsRequests.length = 0;

        for(var posNegRequestsCount2 = 0; posNegRequestsCount2 < GetTweetPosNegRequests.length; posNegRequestsCount2++){
            GetTweetPosNegRequests[posNegRequestsCount2].cancelChecker("New Request");
        }
        GetTweetPosNegRequests.length = 0;

        for(var getTopTweetsRequestsCount2 = 0; getTopTweetsRequestsCount2 < GetTweetRequests.length; getTopTweetsRequestsCount2++){
            GetTweetRequests[getTopTweetsRequestsCount2].cancelTweet("New Request");
        }
        GetTweetRequests.length = 0;

        //getting top good bad, tweets
        var topResultCount = 5; // change here how much you need to get... hehe mama ganne 5i :D
        $scope.positives.length = 0;
        $scope.negatives.length = 0;

        currentTopTweetResponse["pos"].length = 0;
        currentTopTweetResponse["neg"].length = 0;

        $scope.justTweets["pos"].length = 0;
        $scope.justTweets["neg"].length = 0;

        $scope.topAnalyzer["pos"].length = 0;
        $scope.topAnalyzer["neg"].length = 0;

        getTops.setTops($scope.search, topResultCount, topResultCount, $scope);

        //getting to pie chart...
        // 20 change how much time you need from twitter... 1 ~ (aaaasannawa)100i.. sometimes under 40 but taking as near 100 :D
        getPosNeg.setPosNeg($scope.search, 2, $scope);
    };

    $scope.newSearch = function(search){
        $scope.search = search;
        $window.scrollTo(0, 0);
    }

    $scope.loadHowSentimentWorks = function(number, type){

        if($scope.justTweets[type][number]){
            $scope.justTweets[type][number] = false;
            $scope.topAnalyzer[type][number] = true;
        } else {
            $scope.justTweets[type][number] = true;
            $scope.topAnalyzer[type][number] = false;
        }
    }
});

twitterThing.service("getTweets", function($http, $q) {

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

twitterThing.service("checkPosNeg", function($http, $q) {

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

twitterThing.service("settingTopTweetAnalyzer", function(){

    var settingAnalyzer = function(array, index, result){

        var totalValue = 0;

        var splitText = array[index]["text"].split(" ");

        for(var i = 0; i < splitText.length; i++) {

            if(splitText[i].replace(/[^a-zA-Z]+/g, '').toLowerCase().indexOf("httpstco") >= 0){
                continue;
            }

            var foundedIndex = -1, color = "", str = "", value = 0;

            for (var j = 0; j < result["keywords"].length; j++) {

                if (splitText[i].toLowerCase().indexOf(result["keywords"][j]["word"]) >= 0) {
                    foundedIndex = j;
                }
            }

            if (foundedIndex != -1) {
                if (result["keywords"][foundedIndex]["score"] > 0) {
                    color = "green";
                    str = splitText[i].replace(/[^a-zA-Z]+/g, '');
                    value = result["keywords"][foundedIndex]["score"];
                } else {
                    color = "red";
                    str = splitText[i].replace(/[^a-zA-Z]+/g, '');
                    value = result["keywords"][foundedIndex]["score"];
                }
            } else {
                color = "black";
                str = splitText[i].replace(/[^a-zA-Z]+/g, '');
            }

            totalValue += value;

            array[index]["analyzed"].push({
                color: color,
                word: str
            });
        }

        array[index]["total"] = (totalValue > 0) ? totalValue : (-1 * totalValue);
    };

    return {
        settingAnalyzer: settingAnalyzer
    };
});

twitterThing.factory('getPosNeg', function(getTweets, checkPosNeg) {
    function setPosNeg(search, count, $scope) {
        if (count > 0) {

            var tweet = getTweets.getTweets(search, maxIDPopular, 1);
            tweet.tweet.then(function (response) {
                if (response["Error"] == undefined) {
                    for (var i = 0; i < response.length - 1; i++) {
                        (function (response, i) {

                            var posNeg = checkPosNeg.getType(response[i]["text"]);
                            posNeg.type.then(function (result) {

                                if(result["score"] >= 0.05 || result["score"] <= -0.05 || result["ratio"] == 1) {

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

                                    count--;
                                }

                                if (i == Math.round(response.length * 20 / 100)) {
                                    maxIDSearch = response[response.length - 1];
                                    return setPosNeg(search, count, $scope);
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

twitterThing.factory('getTops', function(getTweets, checkPosNeg, settingTopTweetAnalyzer) {

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

                            if (result["type"] == "positive" && (result["score"] >= 0.05 || result["ratio"] == 1) && !$scope.positives.some(function(el) { return el.text === response[i]["text"]; })) {
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
                            } else if (result["type"] == "negative" && (result["score"] <= -0.05 || result["ratio"] == 1) && !$scope.negatives.some(function(el) { return el.text === response[i]["text"]; })) {
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

twitterThing.directive('topTweet', function($compile){
    return {
        scope: {
            tweet: '=tweet'
        },
        controller: function($scope, $element) {

            var ele = $compile( "<div style='word-wrap: break-word'></div>" )( $scope );
            var currentTypingLabel = $compile( "<span style='font-weight: bold;' ></span>" )( $scope );

            var tweetTxt = $scope.tweet.split(" ");
            var previousSpecialDetail = false;

            for(var i = 0; i < tweetTxt.length; i++){
                if(tweetTxt[i][0] == "@" || tweetTxt[i][0] == "#"){
                    var userAccount;
                    if(tweetTxt[i][0] == "#") {

                        userAccount = [];

                        var replacingString = tweetTxt[i].replace("#", ",%.%#")

                        var hashTags = replacingString.split(",%.%");
                        for(var j = 0; j < hashTags.length; j++){

                            var word = hashTags[j].substring(1);
                            if(/^[a-zA-Z0-9]+$/.test(word)) {
                                userAccount[j] = $compile('<span ng-click="$parent.newSearch(\'' + hashTags[j] + '\')" style="text-decoration: underline; color: blue; cursor:pointer; font-weight: bold;">' + hashTags[j] + '</span>')($scope);
                            } else {
                                var lastLetterIndex = 0;
                                for(var k = 0; k < word.length; k++){
                                    if(!(/^[a-zA-Z0-9]/.test(word[k]))){
                                        lastLetterIndex = k;
                                        break;
                                    }
                                }

                                if(lastLetterIndex != 0) {
                                    userAccount[j] = $compile(
                                        '<span ng-click="$parent.newSearch(\'' + hashTags[j].substring(0, lastLetterIndex + 1) + '\')" style="text-decoration: underline; color: blue; cursor:pointer; font-weight: bold;">' + hashTags[j].substring(0, lastLetterIndex + 1) + '</span>' +
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
                        userAccount = $compile('<span style="color: blue; text-decoration: underline; cursor:pointer; font-weight: bold;">' + tweetTxt[i] + '</span>')($scope);
                    }

                    ele.append(userAccount);
                    previousSpecialDetail = true;
                } else {
                    if(previousSpecialDetail && currentTypingLabel.text() != ""){
                        previousSpecialDetail = false;
                        ele.append(currentTypingLabel);
                        currentTypingLabel = $compile( "<span style='font-weight: bold;'></span>" )( $scope );
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

//twitterThing.directive('sentimentHowToPopOver', function () {
//
//    return {
//        restrict: "A",
//        link: function (scope, element, attrs) {
//            var options = {
//                content: document.getElementById("sentiment-howto").innerHTML,
//                placement: "bottom",
//                html: true,
//                trigger: "hover"
//            };
//            $(element).popover(options);
//        }
//    };
//});