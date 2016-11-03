/**
 * Created by Sahan on 11/1/2016.
 */

var serviceName = 'searchLogService';

app.service(serviceName,
    ['$http', 'API_URL', '$location', 'toaster',  'SUCCESS', 'ERROR',
        function ($http, API_URL, $location, toaster, SUCCESS, ERROR) {


            this.loadUsagePercentages = function (callback) {

                var url = API_URL + "getPercentageChange";

                /*
                 * HTTP post method to save the user data to the database.
                 */
                //$http({
                //    method: 'POST', // Method
                //    url: url, // The route to the save user method in the backend
                //    data: $.param(request), // The data that's passed to the back end
                //    headers: {'Content-Type': 'application/x-www-form-urlencoded'} // This is necessary for the post request to work
                //})

                $http.get(url)

                    .success(function (response) {

                        if (response.status === SUCCESS) {
                            callback(response);
                        }

                        else if (response.status === ERROR) {
                            callback(response);
                        }

                        else {

                        }
                    })

                    .error(function () {
                        toaster.error("Error", "Error loading statistics");
                    });


            };




            this.loadUsageStatistics = function (request, callback) {

                var url = API_URL + "getAllSearchLogCount";

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
                            callback(response);
                        }

                        else if (response.status === ERROR) {
                            callback(response);
                        }

                        else {

                        }
                    })

                    .error(function () {
                        toaster.error("Error", "Error loading statistics");
                    });


            };


            /*
             * This function checks the login credentials
             */
            this.saveSearchLogData = function (request, callback) {

                var url = API_URL + "saveSearchLog";

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
                            callback(response);
                        }

                        else if (response.status === ERROR) {
                            callback(response);
                        }

                        else {

                        }
                    })

                    .error(function () {
                        toaster.error("Error", "Error saving search log");
                    });
            };


        }]);
