/**
 * Created by Kasun on 9/23/2016.
 */


var search = "Justin Bieber";

var maxIDSearch = -1, maxIDPopular = -1;

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

var twitterThing = angular.module('myApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

twitterThing.controller('ctrlProf', function($scope, getProf) {

    // 20 change how much time you need from twitter... 1 ~ (aaaasannawa)100i.. sometimes under 40 but taking as near 100 :D


    $scope.selectedAccount = {
        name: 'NoUser'
    };

    $scope.searchCriteria = "";


    /*
    * This function calls the service and gets all the twitter accounts
    * into an array and the first on that list is assigned to the "selectedAccount"
    * scope variable
    */
    $scope.loadProfiles = function() {
        getProf.setProf($scope);

        $scope.selectedAccount = $scope.profiles[0];
    };

    /*
    * This function loads the selected account into the
    * user account section on the right side
    */
    $scope.loadSelection = function(index) {

        $scope.selectedAccount = $scope.profiles[index];
    };
});

twitterThing.factory('getProf', function($http) {

    function setProf($scope){

        $scope.profiles = [];

            $http.get(baseUrl + "/public/get_profiles", {

                /*
                * Since the scope itself is passed to the factory,
                * Can directly access the "searchCriteria" variable
                * SO no need to pass as a parameter, since the ENTIRE
                * scopeis passed to the factory.(this one)
                */
                params: {search: $scope.searchCriteria, maxID: maxIDSearch}
            }).success(function (response) {

                if (response["Error"] == undefined) {

                        $scope.profiles = response;

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