/**
 * Created by Sahan on 10/8/2016.
 */

app.controller('mainCtrl', ['$scope', '$rootScope', '$cookies', '$window', 'toaster', 'SUCCESS', 'ERROR', 'loginService', 'searchLogService', function ($scope, $rootScope, $cookies, $window, toaster, SUCCESS, ERROR, loginService, searchLogService) {




    $rootScope.loggedIn = $cookies.get('loggedIn');
    $rootScope.userRole = $cookies.get('userRole');
    $rootScope.userID = $cookies.get('userID');




    $scope.logout = function(){

        loginService.destroySession();
        
    };

    $scope.saveTweetAnaylysisLog = function (type, keyword) {

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