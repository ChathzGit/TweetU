/**
 * Created by Sahan on 10/11/2016.
 */

app.controller('loginController', ['$scope', '$http', 'API_URL', '$location', 'toaster', 'userAccountService', 'SUCCESS', 'ERROR', 'loginService',
    function ($scope, $http, API_URL, $location, toaster, userAccountService, SUCCESS, ERROR, loginService) {


        $scope.email = "";
        $scope.password = "";

        $scope.checkCredentials = function () {

            var request = {
                email: $scope.email,
                password: $scope.password
            };
            loginService.checkCredentials(request, function (response) {
                if (response.status === SUCCESS) {
                    //toaster.success("Success", "User account created successfully");
                    $location.path('home');
                }

                else if (response.status === ERROR) {
                    toaster.error("Error", "Incorrect User Credentials");
                }

                else {
                    toaster.error("Error", response.error);
                }
            });
            //toaster.error("Error", "User name or password incorrect");
        }

    }]);
