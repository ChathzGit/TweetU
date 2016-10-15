/**
 * Created by Sahan on 8/10/2016.
 */
app.controller('userAccountController', ['$scope', '$http', 'API_URL', '$location', 'toaster', 'userAccountService', 'SUCCESS', 'ERROR',
    function ($scope, $http, API_URL, $location, toaster, userAccountService, SUCCESS, ERROR) {



        /*
        * This is the object that will be passed to the back end to be saved to the database
        * All the values in this object are bound to the html inputs in the .blade file.
        */
        $scope.user = {
            name: "",
            email: "",
            password: "",
            confirmpassword: ""
        };



        /*
        * This function calls the relevant service which in turn calls the server method to save the data
        * Displays an appropriate message depending on the response.
        */
        $scope.save = function () {

            var user = $scope.user;

            alert(user.name);

            /*
            * Calls the angular service dedicated to handle user account features
            */
            userAccountService.saveUserAccount(user, function (response) {

                if (response.status === SUCCESS) {
                    toaster.success("Success", "User account created successfully");
                }

                else if (response.status === ERROR) {
                    toaster.error("Error", response.error);
                }

                else {
                    toaster.error("Error", response.error);
                }


            });

        };

    }]);