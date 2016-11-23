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
        responsive: true,
        hover: {
            mode: 'single'
        }
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

    $scope.tweetChecked = 0;

    $scope.getInfo = function() {

        $scope.isSearched = true;

        if($scope.search != undefined && $scope.search.trim() != "") {
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
