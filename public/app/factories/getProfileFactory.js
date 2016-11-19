/**
 * Created by ACer on 11/19/2016.
 */


app.factory('getProf', function($http) {


    function setProf( $scope){


        $scope.profiles =[];
        //var profiles = [];

        $http.get("get_profiles", {

            /*
             * Since the scope itself is passed to the factory,
             * Can directly access the "searchCriteria" variable
             * SO no need to pass as a parameter, since the ENTIRE
             * scopeis passed to the factory.(this one)
             */
            params: {search: $scope.searchCriteria, maxID: maxIDSearch}
        }).success(function (response) {
            //console.log(response);
            if (response["Error"] == undefined) {

                $scope.profiles = response;
                //callback(profiles);

            } else {
                console.log("Error");
            }
        });
    }

    function getProfileTweets($scope,$sname){
        $scope.HashtagKeys = [];
        $scope.UserMentionKeys = [];
        $scope.RetweetKeys = [];
        $scope.tweets = [];
        $scope.usermentions = [];
        $scope.hashtags = [];
        $scope.retweets = [];
        $scope.locations = [];
        $scope.HashTagPie = false;
        $scope.locations = [];



        $http.get("getProfileTweets", {

            params: {screenName: $sname}
        }).success(function (response) {


            if (response["Error"] == undefined) {

                $scope.tweets = response;


            } else {
                console.log("Error");
                alert('fail')
            }
        });








        $http.get("getTweetInfo", {

            params: {screenName: $sname}
            //    params: {screenName: 'MahelaJay'}
        }).success(function (response) {

            // console.log(response);
            if (response["Error"] == undefined) {


                $scope.usermentions = response['userMentions'];
                $scope.hashtags = response['hashtags'];
                $scope.retweets = response['retweets'];


                $scope.HashtagKeys = Object.keys(response['hashtags']);
                $scope.UserMentionKeys = Object.keys(response['userMentions']);
                $scope.RetweetKeys = Object.keys(response['retweets']);


                //pie chart hashtag
                $scope.HashTagPie = true;
                $scope.labels1 = [ $scope.HashtagKeys[0], $scope.HashtagKeys[1],$scope.HashtagKeys[2],$scope.HashtagKeys[3],$scope.HashtagKeys[4],$scope.HashtagKeys[5],$scope.HashtagKeys[6],$scope.HashtagKeys[7],$scope.HashtagKeys[8],$scope.HashtagKeys[9]];
                $scope.data1 = [$scope.hashtags[$scope.HashtagKeys[0]],$scope.hashtags[$scope.HashtagKeys[1]],$scope.hashtags[$scope.HashtagKeys[2]],$scope.hashtags[$scope.HashtagKeys[3]],$scope.hashtags[$scope.HashtagKeys[4]],$scope.hashtags[$scope.HashtagKeys[5]],$scope.hashtags[$scope.HashtagKeys[6]],$scope.hashtags[$scope.HashtagKeys[7]],$scope.hashtags[$scope.HashtagKeys[8]],$scope.hashtags[$scope.HashtagKeys[9]]];
                $scope.colors1 = ['#88ff4d', '#ffff00','#88ff4d','#66ccff','#660000','#8000ff','#ff00ff','#40ff00','#00ff00','#ff1a1a'];
                $scope.options1 =  {
                    responsive: false,
                    maintainAspectRatio: false
                }


                //pie chart user mentions
                $scope.HashTagPie = true;
                $scope.labels2 = [ $scope.UserMentionKeys[0], $scope.UserMentionKeys[1],$scope.UserMentionKeys[2],$scope.UserMentionKeys[3],$scope.UserMentionKeys[4],$scope.UserMentionKeys[5],$scope.UserMentionKeys[6],$scope.UserMentionKeys[7],$scope.UserMentionKeys[8],$scope.UserMentionKeys[9]];
                $scope.data2 = [$scope.usermentions[$scope.UserMentionKeys[0]],$scope.usermentions[$scope.UserMentionKeys[1]],$scope.usermentions[$scope.UserMentionKeys[2]],$scope.usermentions[$scope.UserMentionKeys[3]],$scope.usermentions[$scope.UserMentionKeys[4]],$scope.usermentions[$scope.UserMentionKeys[5]],$scope.usermentions[$scope.UserMentionKeys[6]],$scope.usermentions[$scope.UserMentionKeys[7]],$scope.usermentions[$scope.UserMentionKeys[8]],$scope.usermentions[$scope.UserMentionKeys[9]]];
                $scope.colors2 = ['#88ff4d', '#ffff00','#88ff4d','#66ccff','#660000','#8000ff','#ff00ff','#40ff00','#00ff00','#ff1a1a'];
                $scope.options2 =  {
                    responsive: false,
                    maintainAspectRatio: false
                }


                //$scope.labels = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
                //$scope.data = [300, 500, 100];

                //console.log($scope.HashtagValues);
            } else {
                console.log("Error");
                alert('fail')
            }

        });








        //$http.get("getUserLocation", {
        //
        //    params: {screenName: $sname}
        //    //params: {screenName: '@KasunKodithuwak'}
        //}).success(function (response) {
        //
        //
        //    if (response["Error"] == undefined) {
        //
        //        $scope.locations = response['l'];
        //
        //        console.log( $scope.locations);
        //        console.log( response['locations']);
        //
        //    } else {
        //        console.log("Error");
        //        alert('fail')
        //    }
        //});




    }

    return {
        setProf : function ($scope) {
            return setProf($scope);
        },
        getProfileTweets : function ($scope,$sname) {
            return getProfileTweets($scope,$sname);
        }

    }
});
