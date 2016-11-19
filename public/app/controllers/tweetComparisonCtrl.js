/**
 * Created by ACer on 11/19/2016.
 */


app.controller('tweetComparisonCtrl', function($scope, comparisonFactory,  $window, $timeout, $http) {

    $scope.loading = false;


    $scope.getInfo = function() {

        $scope.loading = true;

        comparisonFactory.setPosNeg($scope.search, 2, $scope);
        comparisonFactory.setPosNeg2($scope.search2, 2, $scope);
    };

});
