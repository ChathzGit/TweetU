/**
 * Created by Sahan on 10/8/2016.
 */

app.controller('mainCtrl', ['$scope', '$window', 'toaster', 'SUCCESS', 'ERROR', 'searchLogService', function ($scope, $window, toaster, SUCCESS, ERROR, searchLogService) {


    $scope.checkSearchLog = function () {

        var request = {
            key_word : "WOWOWWW",
            type: "1",
            user_id: "2",
            timestamp: "2016-11-22 10:10:00"
        };

        searchLogService.saveSearchLogData(request, function (response) {
            /*
             * On successful authentication, this happens
             */
            if (response.status === SUCCESS) {

                toaster.success("Success");

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