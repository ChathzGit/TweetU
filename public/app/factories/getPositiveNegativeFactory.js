/**
 * Created by ACer on 10/28/2016.
 */



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
