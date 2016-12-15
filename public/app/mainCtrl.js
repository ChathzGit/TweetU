/**
 * Created by Sahan on 10/8/2016.
 */

app.controller('mainCtrl', ['$scope', '$rootScope', '$cookies', '$window', 'toaster', 'SUCCESS', 'ERROR', 'loginService', 'searchLogService', '$http', function ($scope, $rootScope, $cookies, $window, toaster, SUCCESS, ERROR, loginService, searchLogService, $http) {




    /*
    * This function loads the data from the cookies,
    * and stores them in root scope variables.
    */
    $rootScope.loggedIn = $cookies.get('loggedIn');
    $rootScope.userRole = $cookies.get('userRole');
    $rootScope.userID = $cookies.get('userID');




    /*
    * This function is used to log the user out of the system
    */
    $scope.logout = function(){

        loginService.destroySession();
        
    };

    /*
    * This function saves the log into the database, no matter what
    * type of analysis the user conducts.
    */
    $scope.saveTweetAnaylysisLog = function (type, keyword) {

        $http.get("view-cloud?term=" + keyword);

        var userID = $cookies.get('userID');

        if(userID === undefined)
        {
            userID = 0;
        }

        var request = {
            key_word : keyword,
            type: type,
            user_id: userID
        };

        searchLogService.saveSearchLogData(request, function (response) {
            /*
             * On successful authentication, this happens
             */
            if (response.status === SUCCESS) {

            }

            /*
             * If the entered credentials are wrong, this happens
             */
            else if (response.status === ERROR) {
                toaster.error("Error", response.errordetails);
            }

            /*
             * If neither happens, this is there as a last resort
             */
            else {
                toaster.error("Error", response.errordetails);
            }

        });
    };

}]);