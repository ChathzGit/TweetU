/**
 * Created by ACer on 10/28/2016.
 */



app.factory('getPosNeg', function (getTweets, checkPosNeg, setCountry, settingError) {
    function setPosNeg(search, count, $scope) {
        if (count > 0) {

            var tweet = getTweets.getTweets(search, maxIDSearch, 1);
            tweet.tweet.then(function (response) {
                if (response["Error"] == undefined || response.length == 1) {
                    for (var i = 0; i < response.length - 1; i++) {
                        (function (response, i) {

                            var posNeg = checkPosNeg.getType(response[i]["text"]);
                            posNeg.type.then(function (result) {

                                $scope.tweetChecked += 1;

                                if (result["score"] >= 0.1 || result["score"] <= -0.1 || result["ratio"] == 1 || result["ratio"] == -1) {

                                    if ($scope.loading) {
                                        $scope.loading = false;
                                    }

                                    if (result["type"] == "positive") {
                                        pos += 1;
                                    } else if (result["type"] == "negative") {
                                        neg += 1;
                                    }

                                    $scope.data[1] = Math.round(100 * pos / (pos + neg));
                                    $scope.data[0] = Math.round(100 * neg / (pos + neg));
                                }

                                if (i == Math.round(response.length * 80 / 100)) {
                                    maxIDSearch = response[response.length - 1];
                                    count--;
                                    return setPosNeg(search, count, $scope);
                                }


                            });

                            GetTweetPosNegRequests[GetTweetPosNegRequests.length] = posNeg;


                            if (response[i]["location"] != "") {

                                if ($scope.locations[response[i]["location"]] == undefined) {

                                    var settingCountry = setCountry.getCountry(response[i]["location"]);
                                    settingCountry.code.then(function (result) {

                                        if (result["status"] = "OK") {
                                            bigResult : for (var j = 0; j < result["results"].length; j++) {
                                                for (var k = 0; k < result["results"][j]["address_components"].length; k++) {
                                                    if (result["results"][j]["address_components"][k]["types"][0] == "country") {
                                                        var countryCode = settingCountry.countryCodeList(result["results"][j]["address_components"][k]["long_name"]);
                                                        if (countryCode != "0") {

                                                            $scope.totalLocationCount += 1;

                                                            var availableCountryCode = false;
                                                            $scope.fusionChartsMapData.forEach(function(data){
                                                                if (data["id"] == countryCode) {
                                                                    availableCountryCode = true;
                                                                    $scope.locationCount[countryCode] += 1;
                                                                    data["locationPlace"].push(response[j]["location"]);
                                                                }
                                                            });

                                                            if (!availableCountryCode) {

                                                                $scope.locationCount[countryCode] = 1;

                                                                $scope.fusionChartsMapData.push({
                                                                    locationPlace: [response[j]["location"]],
                                                                    id: countryCode,
                                                                    value: 1
                                                                });
                                                            }
                                                        }
                                                        break bigResult;
                                                    }
                                                }
                                            }
                                        }

                                        insideMapHttp--;
                                        if(insideMapHttp <= 0) {
                                            $scope.fusionChartsMapData.forEach(function (data) {

                                                for (var key in $scope.locations) {

                                                    if ($scope.locations.hasOwnProperty(key) && data["locationPlace"].indexOf(key) != -1) {
                                                        var availableCountryCode = data["id"];
                                                        $scope.locationCount[availableCountryCode] += $scope.locations[key];
                                                        $scope.totalLocationCount += $scope.locations[key];
                                                        $scope.locations[key] = 0;
                                                    }

                                                }
                                                var countryCode = data["id"];
                                                data["value"] = Math.round(100 * $scope.locationCount[countryCode] / $scope.totalLocationCount);

                                            });
                                        }
                                    }, function errorCallback() {
                                        insideMapHttp--;
                                        if(insideMapHttp <= 0) {
                                            $scope.fusionChartsMapData.forEach(function (data) {

                                                for (var key in $scope.locations) {

                                                    if ($scope.locations.hasOwnProperty(key) && data["locationPlace"].indexOf(key) != -1) {
                                                        var availableCountryCode = data["id"];
                                                        $scope.locationCount[availableCountryCode] += $scope.locations[key];
                                                        $scope.totalLocationCount += $scope.locations[key];
                                                        $scope.locations[key] = 0;
                                                    }

                                                }
                                                var countryCode = data["id"];
                                                data["value"] = Math.round(100 * $scope.locationCount[countryCode] / $scope.totalLocationCount);

                                            });
                                        }
                                    });

                                    insideMapHttp++;
                                    GetMapCalls[GetMapCalls.length] = settingCountry;

                                    $scope.locations[response[i]["location"]] = 1;

                                } else {

                                    $scope.locations[response[i]["location"]] = +1;

                                    $scope.fusionChartsMapData.forEach(function(data){
                                        if (data["locationPlace"].indexOf(response[i]["location"]) != -1) {
                                            var availableCountryCode = data["id"];
                                            $scope.locationCount[availableCountryCode] += 1;
                                            $scope.totalLocationCount += 1;
                                            $scope.locations[response[i]["location"]] = 0;
                                        }
                                    });
                                }
                            }

                            if (i == (response.length - 2)) {
                                $scope.fusionChartsMapData.forEach(function(data){

                                    for(var key in $scope.locations) {

                                        if ($scope.locations.hasOwnProperty(key) && data["locationPlace"].indexOf(key) != -1) {
                                            var availableCountryCode = data["id"];
                                            $scope.locationCount[availableCountryCode] += $scope.locations[key];
                                            $scope.totalLocationCount += $scope.locations[key];
                                            $scope.locations[key] = 0;
                                        }

                                    }
                                    var countryCode = data["id"];
                                    data["value"] = Math.round(100 * $scope.locationCount[countryCode] / $scope.totalLocationCount);
                                });
                            }
                        })(response, i);
                    }
                } else {
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
