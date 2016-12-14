/**
 * Created by Kasun on 11/19/2016.
 */

app.factory('getInfoProf', function($http,settingError) {

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
        }).then(function (res) {

            var response = res.data;

            if (response["Error"] == undefined) {

                $scope.profiles1 = response;

            } else {
                if($scope.loading){
                    $scope.loading = false;
                }

                settingError.networkError();
            }
        }, function errorCallback() {

            if($scope.loading){
                $scope.loading = false;
            }

            settingError.networkError();
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
        }).then(function (res) {

            var response = res.data;

            if (response["Error"] == undefined) {

                $scope.profiles2 = response;
                $scope.loading = false;

            } else {
                if($scope.loading){
                    $scope.loading = false;
                }

                settingError.networkError();
            }
        }, function errorCallback() {

            if($scope.loading){
                $scope.loading = false;
            }

            settingError.networkError();
        });
    }

    return {
        setProf : function ($scope) {
            return setProf($scope);
        }
    }
});