/**
 * Created by ACer on 10/11/2016.
 */

app.controller('loginController', ['$scope', '$http', 'API_URL', '$location', 'toaster', 'userAccountService', 'SUCCESS', 'ERROR',
    function ($scope, $http, API_URL, $location, toaster, userAccountService, SUCCESS, ERROR) {



        $scope.email = "";
        $scope.password = "";

    }]);
