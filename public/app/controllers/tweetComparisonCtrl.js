/**
 * Created by ACer on 11/19/2016.
 */


app.controller('tweetComparisonCtrl', function($scope, comparisonFactory,  $window, $timeout, $http) {

    $scope.loading = false;
    $scope.isCompared = false;
    $scope.isSearched = false;


    $scope.getInfo = function() {

        $scope.saveTweetAnaylysisLog('3', $scope.search);
        $scope.saveTweetAnaylysisLog('3', $scope.search2);

        $scope.loading = true;
        $scope.isCompared = true;
        $scope.isSearched = true;

        comparisonFactory.setPosNeg($scope.search, 2, $scope);
        comparisonFactory.setPosNeg2($scope.search2, 2, $scope);
    };

});
