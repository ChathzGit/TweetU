/**
* Created by Sahan on 15/10/2016.
*/
app.controller('adminUserAccountController', ['$scope', '$http', 'API_URL', '$location', 'toaster', 'userAccountService', 'SUCCESS', 'ERROR',
    function ($scope, $http, API_URL, $location, toaster, userAccountService, SUCCESS, ERROR) {


        $scope.users = [];

        /*
         * This function will call the service, which in turn will call the
         * server and get the registered users from the database
         */
        $scope.loadUsers = function () {
            userAccountService.loadAllUsers(function (response) {

                $scope.users = response;

            });
        };


        $scope.loadUsers();
    }



   ]);