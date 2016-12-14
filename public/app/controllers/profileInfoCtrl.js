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

        $scope.saveTweetAnaylysisLog('4', $scope.searchCriteria1);
        $scope.saveTweetAnaylysisLog('4', $scope.searchCriteria2);

        //show search result div
        //var link = document.getElementById('searchResult');
        //link.style.visibility = 'visible';

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
        $firstProfFolCount = $scope.selectedFirstProfile["followersCount"];
        $secondProfFolCount = $scope.selectedSecondProfile["followersCount"];
        $totFolCount = $firstProfFolCount + $secondProfFolCount;
        $pcntageFirstAccount = Math.round(($firstProfFolCount/$totFolCount)*100);
        $pcntageSecondAccount =  Math.round(($secondProfFolCount/$totFolCount)*100);

        $scope.labels = [$scope.selectedSecondProfile["name"], $scope.selectedFirstProfile["name"]];
        $scope.data = [$pcntageSecondAccount,$pcntageFirstAccount];
        $scope.colors = ['#4078a2', '#55acee'];
        $scope.options =  {
            maintainAspectRatio: false
        };


        //usage chart
        $firstProfTwtCount = $scope.selectedFirstProfile["tweetcount"];
        $secondProfTwtCount = $scope.selectedSecondProfile["tweetcount"];
        $totTwtCount = $firstProfTwtCount + $secondProfTwtCount;
        $pcntageFirstTwtAccount = Math.round(($firstProfTwtCount/$totTwtCount)*100);
        $pcntageSecondTwtAccount =  Math.round(($secondProfTwtCount/$totTwtCount)*100);

        $scope.labels1 = [$scope.selectedSecondProfile["name"], $scope.selectedFirstProfile["name"]];
        $scope.data1 = [$pcntageSecondTwtAccount,$pcntageFirstTwtAccount];
        $scope.colors1 = ['#88ff4d', '#581845'];
        $scope.options1 =  {
            maintainAspectRatio: false
        }
    };

    $scope.SelectOtherFirst = function(){
        $scope.compare = false;
        $scope.isclicked1stprof = true;
        $scope.firstprofileselected = false;
    };


    $scope.SelectOtherSecond = function(){
        $scope.compare = false;
        $scope.isclicked2ndprof = true;
        $scope.secondprofileselected = false;
    }
});