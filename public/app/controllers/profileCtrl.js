/**
 * Created by ACer on 11/19/2016.
 */



app.controller('ctrlProf', function($scope, getProf) {

    $scope.loading = false;
    $scope.isSearched = false;

    $scope.selectedAccount = "";

    $scope.searchCriteria = "";

    $scope.selectedProfile = "";

    $scope.issearched ;
    $scope.isselected ;
    $scope.isanalized ;


    /*
     * This function calls the service and gets all the twitter accounts
     * into an array and the first on that list is assigned to the "selectedAccount"
     * scope variable
     */
    $scope.loadProfiles = function() {

        $scope.loading = true;
        $scope.isSearched = true;

        $scope.issearched = true;
        $scope.isselected = false;
        $scope.isanalized = false;


        getProf.setProf($scope);

        $scope.selectedAccount = $scope.profiles[0];

    };

    /*
     * This function loads the selected account into the
     * user account section on the right side
     */
    $scope.loadSelection = function(index) {


        $scope.isselected = true;
        $scope.isanalized = false;


        $scope.selectedProfile = index;
        $scope.selectedAccount = $scope.profiles[index];
    };



    $scope.loadTweets = function(scrnName) {

        $scope.loading = true;
        $scope.isanalized = true;

        getProf.getProfileTweets($scope,scrnName);
    };






});
