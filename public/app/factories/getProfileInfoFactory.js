/**
 * Created by Kasun on 11/19/2016.
 */

app.factory('getInfoProf', function($http) {

    function setProf($scope){

        $scope.profiles1 = [];
        $scope.profiles2 = [];

        $http.get("get_profiles", {

            /*
             * Since the scope itself is passed to the factory,
             * Can directly access the "searchCriteria" variable
             * SO no need to pass as a parameter, since the ENTIRE
             * scopeis passed to the factory.(this one)
             */
            params: {search: $scope.searchCriteria1, maxID: maxIDSearch}
        }).success(function (response) {

            if (response["Error"] == undefined) {

                $scope.profiles1 = response;

            } else {
                console.log("Error");
            }
        });

        //2nd profile
        $http.get("get_profiles", {

            /*
             * Since the scope itself is passed to the factory,
             * Can directly access the "searchCriteria" variable
             * SO no need to pass as a parameter, since the ENTIRE
             * scopeis passed to the factory.(this one)
             */
            params: {search: $scope.searchCriteria2, maxID: maxIDSearch}
        }).success(function (response) {

            if (response["Error"] == undefined) {

                $scope.profiles2 = response;
                $scope.loading = false;

            } else {
                console.log("Error");
            }
        });
    }
    return {
        setProf : function ($scope) {
            return setProf($scope);
        }
    }
});