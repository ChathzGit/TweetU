/**
 * Created by Sahan on 10/11/2016.
 */

app.controller('loginController', ['$scope', '$cookies', '$http', 'API_URL', '$location', 'toaster', 'userAccountService', 'SUCCESS', 'ERROR', 'loginService',
    function ($scope,$cookies, $http, API_URL, $location, toaster, userAccountService, SUCCESS, ERROR, loginService) {


        $scope.email = "";
        $scope.password = "";

        /*
        * This is the function that will call the login service and call the server to see
        * if the entered credentials are correct
        */
        $scope.checkCredentials = function () {


            /*
            * This is the response that'll be sent to the server.
            */
            var request = {
                email: $scope.email,
                password: $scope.password
            };

            /*
            * This is the service method that checks the credentials.
            * Sends the "request" object into the service and the service calls the server
            * and returns the appropriate response back to the controller (this file)
            */
            loginService.checkLoginCredentials(request, function (response) {

                /*
                * On successful authentication, this happens
                */
                if (response.status === SUCCESS) {

                    toaster.success("Welcome, "+ response.username);


                    setTimeout(function () {

                        if($cookies.get('userRole') === 'admin')
                        {
                            window.location.href = 'admin_home'
                        }
                        else
                        {
                            window.location.href = 'home'
                        }

                    }, 2000);
                }

                /*
                * If the entered credentials are wrong, this happens
                */
                else if (response.status === ERROR) {
                    toaster.error("Error", response.error);
                }

                /*
                * If neither happens, this is there as a last resort
                */
                else {
                    toaster.error("Error", response.error);
                }
            });
        }

    }]);
