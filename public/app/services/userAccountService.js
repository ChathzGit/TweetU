/**
 * Created by ACer on 10/8/2016.
 */


var serviceName = 'userAccountService';

app.service(serviceName,
    ['$http', 'API_URL', '$location', 'toaster',
        function ($http, API_URL, $location, toaster) {


            this.saveUserAccount = function (request, callback) {

                var url = API_URL + "save_user";

                $http({
                    method: 'POST',
                    url: url,
                    data: $.param(request),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (response) {

                    if (response.status === "Success") {
                        callback(response);
                    }

                    else if (response.status === "Error") {
                        callback(response);
                    }

                    else {

                    }
                }).error(function () {
                    toaster.error("Error", "Error creating user account");
                });
            };


        }]);

