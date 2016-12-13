/**
 * Created by ACer on 10/28/2016.
 */

app.controller('posNegSentiment', function ($scope, getPosNeg, getTops, $window) {

    $scope.loading = false;

    $scope.isSearched = false;

    $scope.labels = ["Negative", "Positive"];
    $scope.data = [50, 50];
    $scope.colors = ['#4078a2', '#77c0f8'];
    $scope.options = {
        legend: {
            display: true,
            reverse: true,
            position: 'top'
        },
        responsive: true,
        hover: {
            mode: 'single'
        }
    };

    $scope.fusionChartsMapData = [];

    $scope.fusionChartsMapDataSource = {
        chart: {
            "entityFillHoverColor": "#cccccc",
            "numberScaleValue": "1,10,10",
            "showLabels": "0",
            "bgColor": "#f1f6fb",
            "theme": "fint",
            "caption": "Twitter Popularity"
        },
        "colorrange": {
            "color": [
                {
                    "minvalue": "0",
                    "maxvalue": "25",
                    "code": "#ABEBC6",
                    "displayValue": "Less"
                },
                {
                    "minvalue": "26",
                    "maxvalue": "50",
                    "code": "#F39C12",
                    "displayValue": "Ok"
                },
                {
                    "minvalue": "51",
                    "maxvalue": "75",
                    "code": "#AF7AC5",
                    "displayValue": "Better"
                },
                {
                    "minvalue": "76",
                    "maxvalue": "100",
                    "code": "#E74C3C",
                    "displayValue": "Perfect"
                }
            ]
        },
        "data":$scope.fusionChartsMapData
    };

    $scope.positives = [];
    $scope.negatives = [];
    $scope.mouseHovered = [];

    $scope.justTweets = [];
    $scope.justTweets["pos"] = [];
    $scope.justTweets["neg"] = [];

    $scope.topAnalyzer = [];
    $scope.topAnalyzer["pos"] = [];
    $scope.topAnalyzer["neg"] = [];

    $scope.locations = [];
    $scope.locationCount = [];
    $scope.totalLocationCount = 0;

    $scope.tweetChecked = 0;

    $scope.getInfo = function() {

        $scope.saveTweetAnaylysisLog('1', $scope.search);

        $scope.isSearched = true;

        if ($scope.search != undefined && $scope.search.trim() != "") {
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

            for (var getMapCallsCount = 0; getMapCallsCount < GetMapCalls.length; getMapCallsCount++) {
                GetMapCalls[getMapCallsCount].cancelMapping("New Request");
            }
            GetMapCalls.length = 0;

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

            pos = 0;
            neg = 0;
            maxIDSearch = -1;
            maxIDPopular = -1;

            getTops.setTops($scope.search, topResultCount, topResultCount, $scope);

            //getting to pie chart...
            // 20 change how much you need from twitter... 1 ~ (aaaasannawa)100i.. sometimes under 40 but taking as near 100 :D

            $scope.data = [50, 50];
            $scope.tweetChecked = 0;

            $scope.fusionChartsMapData.length = 0;
            $scope.locations.length = 0;
            $scope.locationCount.length = 0;

            $scope.totalLocationCount = 0;
            getPosNeg.setPosNeg($scope.search, 10, $scope);
        }
    };

    $scope.newSearch = function(search){
        $scope.search = search;
        $window.scrollTo(0, 0);
    };

    $scope.loadHowSentimentWorks = function(number, type){

        if($scope.justTweets[type][number]){
            $scope.justTweets[type][number] = false;
            $scope.topAnalyzer[type][number] = true;
        } else {
            $scope.justTweets[type][number] = true;
            $scope.topAnalyzer[type][number] = false;
        }
    };
});
