/**
 * Created by Sahan on 10/11/2016.
 */


var serviceName = 'loginService';

app.service(serviceName,
    ['$http', 'API_URL', '$location','$cookies', '$rootScope', 'toaster',  'SUCCESS', 'ERROR',
        function ($http, API_URL, $location,$cookies, $rootScope, toaster, SUCCESS, ERROR) {


            /*
            * This function checks the login credentials
            */
            this.checkLoginCredentials = function (request, callback) {

                var url = API_URL + "check_credentials";

                /*
                 * HTTP post method to save the user data to the database.
                 */
                $http({
                    method: 'POST', // Method
                    url: url, // The route to the save user method in the backend
                    data: $.param(request), // The data that's passed to the back end
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'} // This is necessary for the post request to work
                })

                    .success(function (response) {

                        if (response.status === SUCCESS) {
                            $cookies.put('loggedIn',true);
                            $cookies.put('userID',response.userID);
                            $cookies.put('userRole',response.userRole);

                            callback(response);

                        }

                        else if (response.status === ERROR) {
                            callback(response);
                        }

                        else {

                        }
                    })

                    .error(function () {
                        toaster.error("Error", "Error checking credentials");
                    });
            };







            this.checkSession = function () {

                var url = API_URL + "checkSession";

                /*
                 * HTTP post method to save the user data to the database.
                 */
                $http.get(url)

                    .success(function (response) {

                        if (response.sessionStatus === "active") {
                            $cookies.put('loggedIn',true);

                        }

                        else if (response.sessionStatus === "none") {

                            $cookies.put('loggedIn',true);
                        }

                        else {

                            $cookies.put('loggedIn',true);
                        }
                    })

                    .error(function () {

                    });
            };







            this.destroySession = function () {

                var url = API_URL + "logout";

                /*
                 * HTTP post method to save the user data to the database.
                 */
                $http.get(url)

                    .success(function (response) {

                        if (response.status === SUCCESS) {
                            $cookies.remove('loggedIn');
                            $cookies.remove('userID');
                            $cookies.remove('userRole');

                            $rootScope.loggedIn = $cookies.get('loggedIn');
                            $rootScope.userRole = $cookies.get('userRole');
                            $rootScope.userID = $cookies.get('userID');


                            //window.location.href = 'home'
                        }

                        else if (response.status === ERROR) {
                            toaster.error("Error", "Error ending session");
                        }

                        else {
                            $cookies.put('loggedIn',false);
                        }
                    })

                    .error(function () {

                    });
            };


        }]);
