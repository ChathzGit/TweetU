/**
 * Created by Kasun on 11/19/2016.
 */

app.controller('ctrlInfoProf', function($scope, getInfoProf) {

    $scope.isclicked2ndprof = true;
    $scope.isclicked1stprof = true;
    $scope.compare = false;
    $scope.firstprofileselected = false;
    $scope.secondprofileselected = false;

    $scope.firstProfile="";
    $scope.secondProfile="";
    $scope.selectedFirstProfile="";
    $scope.selectedSecondProfile="";

    $scope.isSearched = false;


    $scope.loading = false;

    $scope.loadProfiles = function() {

        $scope.loading = true;
        $scope.isSearched = true;

        //show search result div
        var link = document.getElementById('searchResult');
        link.style.visibility = 'visible';

        //selected profiles are null when search button is clicked
        $scope.firstProfile="";
        $scope.secondProfile="";

        $scope.isclicked2ndprof = true;
        $scope.isclicked1stprof = true;
        $scope.compare = false;
        $scope.firstprofileselected = false;
        $scope.secondprofileselected = false;

        getInfoProf.setProf($scope);
        
    };

    $scope.selectFirstProfile = function(index) {

        $scope.firstProfile=index;
        $scope.selectedFirstProfile=$scope.profiles1[index];
        $scope.isclicked1stprof = false;
        $scope.firstprofileselected = true;
    };

    $scope.selectSecondProfile = function(index) {

        $scope.secondProfile=index;
        $scope.selectedSecondProfile=$scope.profiles2[index];
        $scope.isclicked2ndprof = false;
        $scope.secondprofileselected = true;
    };

    $scope.Compare = function()
    {

        $scope.compare = true;



        //popularity chart
        $scope.labels = [$scope.selectedSecondProfile["name"], $scope.selectedFirstProfile["name"]];
        $scope.data = [$scope.selectedSecondProfile["followersCount"],$scope.selectedFirstProfile["followersCount"]];
        $scope.colors = ['#88ff4d', '#66ccff'];
        $scope.options =  {
            responsive: false,
            maintainAspectRatio: false
        };


        //usage chart
        $scope.labels1 = [$scope.selectedSecondProfile["name"], $scope.selectedFirstProfile["name"]];
        $scope.data1 = [$scope.selectedSecondProfile["tweetcount"],$scope.selectedFirstProfile["tweetcount"]];
        $scope.colors1 = ['#88ff4d', '#66ccff'];
        $scope.options1 =  {
            responsive: false,
            maintainAspectRatio: false
        }
    }
});