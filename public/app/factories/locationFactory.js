/**
 * Created by Kasun on 11/19/2016.
 */
app.factory('getLocations', function ($http,settingError) {


    function getUseLocations(screenName, count, $scope, $maxid) {
        $scope.alllocations = [];
        if (count > 0) {
            console.log(screenName);
            $http.get("getUserLocation", {

                params: {screenName: screenName, maxid: $maxid}
            }).then(function (res) {

                var response = res.data;

                //console.log(response);
                if (response["Error"] == undefined) {
                    //console.log(response);

                    $scope.alllocations.push(response);
                    $maxid = response[response.length - 1];

                    if(count == 1){

                        console.log($scope.alllocations);
                        //place for chathz code
                        //$scope.alllocations.forEach(function($add){})
                        for(var i = 0; i< $scope.alllocations[0].length - 1; i++){
                            if($scope.locationarray[$scope.alllocations[0][i]] == undefined){
                                $scope.locationarray[$scope.alllocations[0][i]] = 1;
                                //  $scope.locations[$scope.locations.length] = response[i];
                                //  console.log(response[i]);

                                var separators = [' ', '\\\+', '-', '\\\(', '\\\)', '\\*', '/', ':', '\\\?', ',', '!'];
                                var splitted_address = $scope.alllocations[0][i].split(new RegExp(separators.join('|'), 'g'));
                                var address = splitted_address;
                                for(var i=1; i<splitted_address.length; i++){
                                    address = address + " " + splitted_address[i];

                                }
                                var url = "https://maps.googleapis.com/maps/api/geocode/json?address="+address+"&key=AIzaSyDqtKh83UC16va5rExAQkumKax699B-rLY";

                                $scope.getcountryid = function(country_name){
                                    if(country_name == 'Afghanistan'){
                                        return '93';
                                    }
                                    if(country_name == 'Albania'){
                                        return '120';
                                    }
                                    if(country_name == 'Argentina'){
                                        return '25';
                                    }
                                    if(country_name == ''){
                                        return '';
                                    }
                                    if(country_name == 'Australia'){
                                        return '175';
                                    }
                                    if(country_name == 'Austria'){
                                        return '131';
                                    }
                                    if(country_name == 'Bangladesh'){
                                        return '96';
                                    }
                                    if(country_name == 'Belgium'){
                                        return '133';
                                    }
                                    if(country_name == 'Bolivia'){
                                        return '26';
                                    }
                                    if(country_name == 'Brazil'){
                                        return '27';
                                    }
                                    if(country_name == 'Cambodia'){
                                        return '100';
                                    }
                                    if(country_name == 'Canada'){
                                        return '05';
                                    }
                                    if(country_name == 'Chile'){
                                        return '28';
                                    }
                                    if(country_name == 'China'){
                                        return '101';
                                    }
                                    if(country_name == 'Colombia'){
                                        return '29';
                                    }
                                    if(country_name == 'Egypt'){
                                        return '53';
                                    }
                                    if(country_name == 'France'){
                                        return '141';
                                    }
                                    if(country_name == 'Georgia'){
                                        return '103';
                                    }
                                    if(country_name == 'Germany'){
                                        return '142';
                                    }
                                    if(country_name == 'Greece'){
                                        return '143';
                                    }
                                    if(country_name == 'Greenland'){
                                        return '24';
                                    }
                                    if(country_name == 'Haiti'){
                                        return '13';
                                    }
                                    if(country_name == 'Hong Kong'){
                                        return '127';
                                    }
                                    if(country_name == 'Iceland'){
                                        return '145';
                                    }
                                    if(country_name == 'India'){
                                        return '104';
                                    }
                                    if(country_name == 'Indonesia'){
                                        return '105';
                                    }
                                    if(country_name == 'Iran'){
                                        return '106';
                                    }
                                    if(country_name == 'Iraq'){
                                        return '191';
                                    }
                                    if(country_name == 'Ireland'){
                                        return '146';
                                    }
                                    if(country_name == 'Israel'){
                                        return '192';
                                    }
                                    if(country_name == 'Italy'){
                                        return '147';
                                    }
                                    if(country_name == 'Jamaica'){
                                        return '15';
                                    }
                                    if(country_name == 'Japan'){
                                        return '107';
                                    }
                                    if(country_name == 'Jordan'){
                                        return '193';
                                    }
                                    if(country_name == 'Kazakhstan'){
                                        return '108';
                                    }
                                    if(country_name == 'North Korea'){
                                        return '109';
                                    }
                                    if(country_name == 'South Korea'){
                                        return '110';
                                    }
                                    if(country_name == 'Lebanon'){
                                        return '195';
                                    }
                                    if(country_name == 'Liberia'){
                                        return '63';
                                    }
                                    if(country_name == 'Libya'){
                                        return '64';
                                    }
                                    if(country_name == 'Luxembourg'){
                                        return '151';
                                    }
                                    if(country_name == 'Madagascar'){
                                        return '65';
                                    }
                                    if(country_name == 'Malta'){
                                        return '153';
                                    }
                                    if(country_name == 'Mauritius'){
                                        return '92';
                                    }
                                    if(country_name == 'Mexico'){
                                        return '16';
                                    }
                                    if(country_name == 'Netherlands'){
                                        return '157';
                                    }
                                    if(country_name == 'New Zealand'){
                                        return '181';
                                    }
                                    if(country_name == 'Norway'){
                                        return '158';
                                    }
                                    if(country_name == 'Pakistan'){
                                        return '116';
                                    }
                                    if(country_name == 'Philippines'){
                                        return '117';
                                    }
                                    if(country_name == 'Poland'){
                                        return '159';
                                    }
                                    if(country_name == 'Russia'){
                                        return '118';
                                    }
                                    if(country_name == 'Romania'){
                                        return '161';
                                    }
                                    if(country_name == 'Saudi Arabia'){
                                        return '198';
                                    }
                                    if(country_name == 'South Africa'){
                                        return '80';
                                    }
                                    if(country_name == 'Spain'){
                                        return '166';
                                    }
                                    if(country_name == 'Sri Lanka'){
                                        return '120';
                                    }
                                    if(country_name == 'Sweden'){
                                        return '167';
                                    }
                                    if(country_name == 'Switzerland'){
                                        return '168';
                                    }
                                    if(country_name == 'Syria'){
                                        return '199';
                                    }
                                    if(country_name == 'Taiwan'){
                                        return '126';
                                    }
                                    if(country_name == 'Thailand'){
                                        return '122';
                                    }
                                    if(country_name == 'Turkey'){
                                        return '173';
                                    }
                                    if(country_name == 'Uganda'){
                                        return '86';
                                    }
                                    if(country_name == 'Ukraine'){
                                        return '169';
                                    }
                                    if(country_name == 'United Arab Emirates'){
                                        return '200';
                                    }
                                    if(country_name == 'United Kingdom'){
                                        return '170';
                                    }
                                    if(country_name == 'United States'){
                                        return '23';
                                    }
                                    if(country_name == 'Uzbekistan'){
                                        return '124';
                                    }
                                    if(country_name == 'Venezuela'){
                                        return '38';
                                    }
                                    if(country_name == 'Vietnam'){
                                        return '125';
                                    }
                                    else{
                                        return '0';
                                    }

                                };

                                $scope.countries = [];
                                $.get(url, function(data) {
                                    if(data.status == 'OK'){
                                        for(var i=0; i<data.results.length; i++){
                                            for(var x=0; x<data.results[i]["address_components"].length; x++){
                                                if(data.results[i]["address_components"][x]["types"][0] == 'country'){
                                                    $scope.countries.push(data.results[i]["address_components"][x].long_name);




                                                    $scope.counts = {};
                                                    angular.forEach($scope.countries, function (value, key){
                                                        if(value in $scope.counts){
                                                            $scope.counts[value]++;
                                                        }else{
                                                            $scope.counts[value] = 1;
                                                        }
                                                    });

                                                    $scope.contryarray = [];
                                                    angular.forEach($scope.counts, function (value, key){
                                                        //var temparr = [];
                                                        //temparr = [{id:key, value:value}];
                                                        var cid = $scope.getcountryid(key);
                                                        $scope.contryarray.push({id:cid, value:value});
                                                        //$scope.contryarray.push({id:cid, value:value});
                                                    });

                                                    FusionCharts.ready(function(){
                                                        var salesByState = new FusionCharts({
                                                            "type": "maps/worldwithcountries",
                                                            "renderAt": "chartContainer",
                                                            "width": "100%",
                                                            "height": "400",
                                                            "dataFormat": "json",
                                                            "dataSource": {
                                                                "chart": {
                                                                    "caption": "Twitter Popularity",
                                                                    "subcaption": $scope.search,
                                                                    "entityFillHoverColor": "#cccccc",
                                                                    "numberScaleValue": "1,10,10",
                                                                    "showLabels": "0",
                                                                    "theme": "fint"
                                                                },
                                                                "colorrange": {
                                                                    "color": [
                                                                        {
                                                                            "minvalue": "0",
                                                                            "maxvalue": "9",
                                                                            "code": "#ABEBC6",
                                                                            "displayValue": "Less"
                                                                        },
                                                                        {
                                                                            "minvalue": "10",
                                                                            "maxvalue": "19",
                                                                            "code": "#F39C12",
                                                                            "displayValue": "Okay"
                                                                        },
                                                                        {
                                                                            "minvalue": "20",
                                                                            "maxvalue": "29",
                                                                            "code": "#AF7AC5",
                                                                            "displayValue": "Better"
                                                                        },
                                                                        {
                                                                            "minvalue": "30",
                                                                            "maxvalue": "50",
                                                                            "code": "#E74C3C",
                                                                            "displayValue": "Perfect"
                                                                        }
                                                                    ]
                                                                },
                                                                "data":$scope.contryarray,
                                                            }
                                                        });
                                                        salesByState.render();
                                                    });

                                                }
                                            }
                                        }
                                    }
                                });


                            } else {
                                $scope.locationarray[response[i]] += 1;
                            }
                        }

                        $scope.loading = false;
                    }

                    count--;
                    return getUseLocations(screenName, count, $scope, $maxid);




                } else {
                    if($scope.loading){
                        $scope.loading = false;
                    }

                    //settingError.networkError();
                }
            }, function errorCallback() {

                if($scope.loading){
                    $scope.loading = false;
                }

                settingError.networkError();
            });


        }
    }

    return {
        getUseLocations: function (screenName, count, $scope, $maxid) {
            return getUseLocations(screenName, count, $scope, $maxid);
        }
    }
});