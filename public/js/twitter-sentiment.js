var search = "hitler";

var pos = 0, neg = 0, maxIDSearch = -1, maxIDPopular = -1;

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

var twitterThing = angular.module('myApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

twitterThing.controller('ctrlPosNeg', function($scope, getPosNeg) {

    // 20 change how much time you need from twitter... 1 ~ (aaaasannawa)100i.. sometimes under 40 but taking as near 100 :D
    getPosNeg.setPosNeg(20, $scope);
});

twitterThing.factory('getPosNeg', function($http) {
    function setPosNeg(count, $scope){
        if (count > 0) {
            $http.get(baseUrl + "/public/get_tweets", {
                params: {search: search, maxID: maxIDSearch, recent: true}
            }).success(function (response) {

                if (response["Error"] == undefined) {
                    for (var i = 0; i < response.length - 1; i++) {

                        //var sentences = [];
                        //for(var j = i; (j < response.length - 1 && j <= i + 2); j++){
                        //    sentences[sentences.length] = response[j];
                        //}
                        //i += sentences.length;
                        //
                        //$http.get(baseUrl + "/public/get_pos_neg", {
                        //    params : {sentences: JSON.stringify(sentences)}
                        //}).success(function (percentages) {
                        //    pos += percentages["positive"];
                        //    neg += percentages["negative"];
                        //
                        //    $scope.positive = pos;
                        //    $scope.negative = neg;
                        //});

                        $http.get("https://twinword-sentiment-analysis.p.mashape.com/analyze/", {
                            headers: {
                                'X-Mashape-Key': 'ojF8QuQu1ZmshWjxUrOGDmm5iuV2p1S2cpwjsnmHgOkkAsMmzO',
                                'Accept': 'application/json'
                            },
                            params: {text: response[i]}
                        }).success(function (result) {

                            if (result["type"] == "positive") {
                                pos += 1;
                            } else if (result["type"] == "negative") {
                                neg += 1;
                            }

                            $scope.positive = "Positive tweets for " + search + " : " + Math.round(100 * pos / (pos + neg)) + "%";
                            $scope.negative = "Negative tweets for " + search + " : " + Math.round(100 * neg / (pos + neg)) + "%";
                        });
                    }

                    maxIDSearch = response[response.length - 1];
                    return setPosNeg(count - 1, $scope);
                } else {
                    console.log("Error");
                }
            });
        } else {
            return;
        }
    }

    return {
        setPosNeg : function (count, $scope) {
            return setPosNeg(count, $scope);
        }
    }
});

twitterThing.controller('topPosNeg', function($scope, getTops){

    // change here how much you need to get... hehe mama ganne 5i :D
    var topResultCount = 5;

    $scope.positives = [];
    $scope.negatives = [];
    getTops.setTops(topResultCount, topResultCount, $scope);
});

twitterThing.factory('getTops', function($http) {
    function setTops(countPos, countNeg, $scope) {
        $http.get(baseUrl + "/public/get_tweets", {
            params: {search: search, maxID: maxIDPopular, recent: false}
        }).success(function (response) {
            if (response["Error"] == undefined) {
                for (var i = 0; i < response.length - 1; i++) {

                    (function (response, i) {
                        $http.get("https://twinword-sentiment-analysis.p.mashape.com/analyze/", {
                            headers: {
                                'X-Mashape-Key': 'ojF8QuQu1ZmshWjxUrOGDmm5iuV2p1S2cpwjsnmHgOkkAsMmzO',
                                'Accept': 'application/json'
                            },
                            params: {text: response[i]}
                        }).success(function (result) {
                            if (result["type"] == "positive") {
                                if(countPos > 0) {
                                    $scope.positives.push({text: response[i]});
                                    countPos--;
                                }
                            } else if (result["type"] == "negative") {
                                if(countNeg > 0) {
                                    $scope.negatives.push({text: response[i]});
                                    countNeg--;
                                }
                            }

                            if (i == response.length - 2 && (countNeg > 0 || countPos > 0)) {
                                return setTops(countPos, countNeg, $scope);
                            } else if(countNeg == 0 && countPos == 0){
                                return;
                            }
                        });
                    })(response, i);
                }
                maxIDPopular = response[response.length - 1];
            }
        });
    }

    return {
        setTops : function(countPos, countNeg, $scope){
            return setTops(countPos, countNeg, $scope);
        }
    }
});