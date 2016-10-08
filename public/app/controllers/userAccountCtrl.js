/**
 * Created by ACer on 10/8/2016.
 */
app.controller('userAccountController', ['$scope', '$http', 'API_URL', '$location', 'toaster', 'userAccountService',
    function ($scope, $http, API_URL, $location, toaster, userAccountService) {


        $scope.employee = {
            name: "",
            email: "",
            password: "",
            confirmpassword: ""
        };


        $scope.save = function () {

            var employee = $scope.employee;

            userAccountService.saveUserAccount(employee, function (response) {

                if (response.status === "Success") {
                    toaster.success("Success", "User account created successfully");
                }

                else if (response.status === "Error") {
                    toaster.error("Error", response.error);
                }

                else {
                    toaster.error("Error", response.error);
                }


            });

        };


    }]);