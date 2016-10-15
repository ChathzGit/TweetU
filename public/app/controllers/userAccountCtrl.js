/**
 * Created by Sahan on 10/8/2016.
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


        $scope.users = [
            {
                name: "ddddd",
                email: "asdas",
                password: "asdasd",
                confirmpassword: "asdas"
            },
            {
                name: "asd",
                email: "asda",
                password: "asda",
                confirmpassword: "asdas"
            }
        ];


        /*
        * This function calls the relevant service which in turn calls the server method to save the data
        * Displays an appropriate message depending on the response.
        */
        $scope.save = function () {

            var user = $scope.user;

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





        $scope.loadUsers = function () {


        }


    }]);