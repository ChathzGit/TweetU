/**
 * Created by Kasun on 11/19/2016.
 */
app.factory('getLocations', function ($http) {
    function getUseLocations(screenName, count, $scope, $maxid) {
        if (count > 0) {

            $http.get("getUserLocation", {

                params: {screenName: screenName, maxid: $maxid}
                //params: {screenName: '@KasunKodithuwak'}
            }).success(function (response) {


                if (response["Error"] == undefined) {



                    //console.log(response);
                    for(var i = 0; i< response.length - 1; i++){
                        if($scope.locationarray[response[i]] == undefined){
                            $scope.locationarray[response[i]] = 1;
                          //  $scope.locations[$scope.locations.length] = response[i];
                          //  console.log(response[i]);
                            //get country
                            var separators = [' ', '\\\+', '-', '\\\(', '\\\)', '\\*', '/', ':', '\\\?', ',', '!'];
                            var splitted_address = response[i].split(new RegExp(separators.join('|'), 'g'));
                            var address = splitted_address;
                            for(var i=1; i<splitted_address.length; i++){
                                address = address + " " + splitted_address[i];
                            }
                            var url = "https://maps.googleapis.com/maps/api/geocode/json?address="+address+"&key=AIzaSyDqtKh83UC16va5rExAQkumKax699B-rLY";

                            $scope.countries = [];
                            $.get(url, function(data) {
                                if(data.status == 'OK'){
                                    for(var i=0; i<data.results.length; i++){
                                        for(var x=0; x<data.results[i]["address_components"].length; x++){
                                            if(data.results[i]["address_components"][x]["types"][0] == 'country'){
                                                $scope.countries.push(data.results[i]["address_components"][x].long_name);
                                            }
                                        }
                                    }
                                }
                            });

                        } else {
                            $scope.locationarray[response[i]] += 1;
                        }
                    }


                    $maxid = response[response.length - 1];

                    if(count == 1){
                        //console.log($scope.locationarray);
                        //console.log($scope.locations);
                    }


                } else {
                    console.log("Error");
                    alert('fail')
                }
            });

            count--;
            return getUseLocations(screenName, count, $scope, $maxid);
        } else{
            return;
        }
    }

    return {
        getUseLocations: function (screenName, count, $scope, $maxid) {
            return getUseLocations(screenName, count, $scope, $maxid);
        }
    }
});