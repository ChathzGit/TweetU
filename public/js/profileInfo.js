/**
 * Created by Kasun on 10/9/2016.
 */

var maxIDSearch = -1, maxIDPopular = -1;

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

var twitterThing = angular.module('myAppProfile', ['chart.js'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

});

twitterThing.controller('ctrlProf', function($scope, getProf) {

    $scope.isclicked2ndprof = true;
    $scope.isclicked1stprof = true;
    $scope.compare = false;
    $scope.firstprofileselected = false;
    $scope.secondprofileselected = false;

    $scope.firstProfile="";
    $scope.secondProfile="";
    $scope.selectedFirstProfile="";
    $scope.selectedSecondProfile="";

    $scope.loadProfiles = function() {

        //show search result div
        var link = document.getElementById('searchResult');
        link.style.visibility = 'visible';

        //selected profiles are null when search button is clicked
        $scope.firstProfile="";
        $scope.secondProfile="";

        $scope.isclicked2ndprof = true;
        $scope.isclicked1stprof = true;
        $scope.compare = false;
        $scope.firstprofileselected = false;
        $scope.secondprofileselected = false;

        getProf.setProf($scope);

        $scope.selectedAccount = $scope.profiles[0];
    };

    $scope.selectFirstProfile = function(index) {

        $scope.firstProfile=index;
        $scope.selectedFirstProfile=$scope.profiles1[index];
        $scope.isclicked1stprof = false;
        $scope.firstprofileselected = true;
    }
    $scope.selectSecondProfile = function(index) {

        $scope.secondProfile=index;
        $scope.selectedSecondProfile=$scope.profiles2[index];
        $scope.isclicked2ndprof = false;
        $scope.secondprofileselected = true;
    }

    $scope.Compare = function()
    {

        $scope.compare = true;



        //popularity chart
        $scope.labels = [$scope.selectedSecondProfile["name"], $scope.selectedFirstProfile["name"]];
        $scope.data = [$scope.selectedSecondProfile["followersCount"],$scope.selectedFirstProfile["followersCount"]];
        $scope.colors = ['#88ff4d', '#66ccff'];
        $scope.options =  {
            responsive: false,
            maintainAspectRatio: false
        }


        //usage chart
        $scope.labels1 = [$scope.selectedSecondProfile["name"], $scope.selectedFirstProfile["name"]];
        $scope.data1 = [$scope.selectedSecondProfile["tweetcount"],$scope.selectedFirstProfile["tweetcount"]];
        $scope.colors1 = ['#88ff4d', '#66ccff'];
        $scope.options1 =  {
            responsive: false,
            maintainAspectRatio: false
        }
    }
});

twitterThing.factory('getProf', function($http) {

    function setProf($scope){

        $scope.profiles1 = [];
        $scope.profiles2 = [];

        $http.get("get_profiles", {

            /*
             * Since the scope itself is passed to the factory,
             * Can directly access the "searchCriteria" variable
             * SO no need to pass as a parameter, since the ENTIRE
             * scopeis passed to the factory.(this one)
             */
            params: {search: $scope.searchCriteria1, maxID: maxIDSearch}
        }).success(function (response) {

            if (response["Error"] == undefined) {

                $scope.profiles1 = response;

            } else {
                console.log("Error");
            }
        });

        //2nd profile
        $http.get("get_profiles", {

            /*
             * Since the scope itself is passed to the factory,
             * Can directly access the "searchCriteria" variable
             * SO no need to pass as a parameter, since the ENTIRE
             * scopeis passed to the factory.(this one)
             */
            params: {search: $scope.searchCriteria2, maxID: maxIDSearch}
        }).success(function (response) {

            if (response["Error"] == undefined) {

                $scope.profiles2 = response;

            } else {
                console.log("Error");
            }
        });
    }
    return {
        setProf : function ($scope) {
            return setProf($scope);
        }
    }
});
