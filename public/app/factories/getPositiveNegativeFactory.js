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

                                    $scope.data[0] = Math.round(100 * pos / (pos + neg));
                                    $scope.data[1] = Math.round(100 * neg / (pos + neg));
                                }

                                if (i == Math.round(response.length * 80 / 100)) {
                                    maxIDSearch = response[response.length - 1];
                                    count--;
                                    return setPosNeg(search, count, $scope);
                                }


                            });

                            GetTweetPosNegRequests[GetTweetPosNegRequests.length] = posNeg;


                            // network baageta stop ooniii.....

                            if (response[i]["location"] != "") {

                                if ($scope.locations[response[i]["location"]] == undefined) {

                                    var settingCountry = setCountry.getCountry(response[i]["location"]);
                                    settingCountry.code.then(function (result) {

                                        if (result["status"] = "OK") {
                                            bigResult : for (var i = 0; i < result["results"].length; i++) {
                                                for (var j = 0; j < result["results"][i]["address_components"].length; j++) {
                                                    if (result["results"][i]["address_components"][j]["types"][0] == "country") {
                                                        var countryCode = settingCountry.countryCodeList(result["results"][i]["address_components"][j]["long_name"]);
                                                        if (countryCode != "0") {

                                                            var availableCountryCode = false;
                                                            $scope.fusionChartsMapData.forEach(function(data){
                                                                if (data["id"] == countryCode) {
                                                                    availableCountryCode = true;
                                                                }
                                                            });

                                                            if (availableCountryCode) {

                                                                $scope.locationCount[countryCode] += 1;
                                                                $scope.totalLocationCount += 1;

                                                                $scope.fusionChartsMapData[countryCode]["locationPlace"].push(response[i]["location"]);
                                                            } else {

                                                                $scope.locationCount[countryCode] = 1;

                                                                if ($scope.totalLocationCount == 0) {
                                                                    $scope.totalLocationCount = 1;
                                                                }

                                                                $scope.fusionChartsMapData[countryCode] = {
                                                                    locationPlace: [response[i]["location"]],
                                                                    id: countryCode,
                                                                    value: 1
                                                                };
                                                            }
                                                        }
                                                        break bigResult;
                                                    }
                                                }
                                            }
                                        }
                                    });

                                    GetMapCalls[GetMapCalls.length] = settingCountry;

                                    $scope.locations[response[i]["location"]] = 1;

                                } else {
                                    $scope.locations[response[i]["location"]] += 1;

                                    $scope.fusionChartsMapData.forEach(function(data){
                                        if (data["locationPlace"].indexOf(response[i]["location"]) != -1) {
                                            var availableCountryCode = data["id"];
                                            $scope.locationCount[availableCountryCode] += 1;
                                            $scope.totalLocationCount += 1;
                                        }
                                    });
                                }
                            }

                            if (i == (response.length - 2)) {
                                $scope.fusionChartsMapData.forEach(function(data){
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

                        settingError.networkError();
                    }
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
