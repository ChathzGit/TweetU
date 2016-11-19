/**
 * Created by ACer on 11/19/2016.
 */



app.controller('ctrlProf', function($scope, getProf) {


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

        $scope.issearched = true;
        $scope.isselected = false;
        $scope.isanalized = false;

        //show search result div
        var link = document.getElementById('searchResult');
        link.style.visibility = 'visible';

        getProf.setProf($scope.searchCriteria, function(response){
            $scope.profiles = response;
        });

        $scope.selectedAccount = $scope.profiles[0];
    };

    /*
     * This function loads the selected account into the
     * user account section on the right side
     */
    $scope.loadSelection = function(index) {


        $scope.issearched = false;
        $scope.isselected = true;

        //hide search result div
        var link = document.getElementById('searchResult');
        link.style.visibility = 'hidden';

        $scope.selectedProfile = index;
        $scope.selectedAccount = $scope.profiles[index];
    };



    $scope.loadTweets = function(scrnName) {

        $scope.isanalized = true;

        getProf.getProfileTweets($scope,scrnName);
    };






});
