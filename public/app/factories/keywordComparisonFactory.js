/**
 * Created by ACer on 11/19/2016.
 */

app.factory('comparisonFactory', function(simpleGetTweets, simpleCheckPosNeg) {
    function setPosNeg(search, count, $scope, $http) {
        $scope.countries = [];

        if (count > 0) {


            var tweet = simpleGetTweets.getTweets(search, maxIDPopular, 1);
            tweet.tweet.then(function (response) {
                if (response["Error"] == undefined) {

                    for (var i = 0; i < response.length - 1; i++) {
                        (function (response, i) {

                            //get country
                            var separators = [' ', '\\\+', '-', '\\\(', '\\\)', '\\*', '/', ':', '\\\?', ',', '!'];
                            var splitted_address = response[i]["tweeterslocation"].split(new RegExp(separators.join('|'), 'g'));
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
                                if(country_name == '	Haiti'){
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

                            $.get(url, function(data) {
                                if(data.status == 'OK'){
                                    //console.log(data.results);
                                    for(var i=0; i<data.results.length; i++){
                                        //console.log(data.results[i]["address_components"]);
                                        for(var x=0; x<data.results[i]["address_components"].length; x++){
                                            //console.log(data.results[i]["address_components"][x]["types"]);
                                            if(data.results[i]["address_components"][x]["types"][0] == 'country'){
                                                //console.log(data.results[i]["address_components"][x].long_name);
                                                $scope.countries.push(data.results[i]["address_components"][x].long_name);

                                                //console.log($scope.countries.length);

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
                                                });

                                                //console.log($scope.contryarray);



                                                FusionCharts.ready(function(){
                                                    var salesByState = new FusionCharts({
                                                        "type": "maps/worldwithcountries",
                                                        "renderAt": "chartContainer",
                                                        "width": "600",
                                                        "height": "400",
                                                        "dataFormat": "json",
                                                        "dataSource": {
                                                            "chart": {
                                                                "caption": "Criteria One",
                                                                "subcaption": "Last year",
                                                                "entityFillHoverColor": "#cccccc",
                                                                "numberScaleValue": "1,10,10",
                                                                "showLabels": "0",
                                                                "theme": "fint"
                                                            },
                                                            "colorrange": {
                                                                "color": [
                                                                    {
                                                                        "minvalue": "0",
                                                                        "maxvalue": "24",
                                                                        "code": "#ABEBC6",
                                                                        "displayValue": "Less"
                                                                    },
                                                                    {
                                                                        "minvalue": "25",
                                                                        "maxvalue": "49",
                                                                        "code": "#F39C12",
                                                                        "displayValue": "Okay"
                                                                    },
                                                                    {
                                                                        "minvalue": "50",
                                                                        "maxvalue": "74",
                                                                        "code": "#AF7AC5",
                                                                        "displayValue": "Better"
                                                                    },
                                                                    {
                                                                        "minvalue": "75",
                                                                        "maxvalue": "100",
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

                            var posNeg = simpleCheckPosNeg.getType(response[i]["text"]);
                            posNeg.type.then(function (result) {

                                if(result["score"] >= 0.05 || result["score"] <= -0.05 || result["ratio"] == 1) {

                                    if ($scope.loading) {
                                        $scope.loading = false;
                                    }

                                    if (result["type"] == "positive") {
                                        pos += 1;
                                    } else if (result["type"] == "negative") {
                                        neg += 1;
                                    }

                                    $scope.positive = Math.round(100 * pos / (pos + neg));
                                    $scope.negative = Math.round(100 * neg / (pos + neg));

                                    //console.log("data1");
                                    //console.log($scope.positive);
                                    //console.log($scope.negative);

                                    //pie chart
                                    $scope.labels = ["Good", "Bad"];
                                    $scope.data = [$scope.positive, $scope.negative];
                                    $scope.colors = ['#72C02C', '#3498DB', '#717984', '#F1C40F'];
                                    $scope.options =  {};



                                    count--;
                                }

                                if (i == Math.round(response.length * 20 / 100)) {
                                    maxIDSearch = response[response.length - 1];
                                    return setPosNeg(search, count, $scope);
                                }


                            });

                        })(response, i);
                    }
                } else {
                    console.log("Error in setposneg 1");
                }
            });


        } else {
            return;
        }
    }

    function setPosNeg2(search, count, $scope, $http, $sce) {
        $scope.countries2 = [];
        $scope.trialtweets = [];

        //$.get(baseUrl + "/public/get_ombeds").then(function (data) {
        //
        //    $scope.trialtweets.push(data);
        //    console.log(data);
        //});

        if (count > 0) {

            var tweet = simpleGetTweets.getTweets(search, maxIDPopular2, 1);
            tweet.tweet.then(function (response) {
                if (response["Error"] == undefined) {

                    for (var i = 0; i < response.length - 1; i++) {
                        (function (response, i) {

                            //get country
                            var separators = [' ', '\\\+', '-', '\\\(', '\\\)', '\\*', '/', ':', '\\\?', ',', '!'];
                            var splitted_address = response[i]["tweeterslocation"].split(new RegExp(separators.join('|'), 'g'));
                            var address = splitted_address;
                            for(var i=1; i<splitted_address.length; i++){
                                address = address + " " + splitted_address[i];
                            }
                            var url = "https://maps.googleapis.com/maps/api/geocode/json?address="+address+"&key=AIzaSyDqtKh83UC16va5rExAQkumKax699B-rLY";

                            $scope.getcountryid2 = function(country_name){
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
                                if(country_name == '	Haiti'){
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

                            $.get(url, function(data) {
                                if(data.status == 'OK'){
                                    //console.log(data.results);
                                    for(var i=0; i<data.results.length; i++){
                                        //console.log(data.results[i]["address_components"]);
                                        for(var x=0; x<data.results[i]["address_components"].length; x++){
                                            //console.log(data.results[i]["address_components"][x]["types"]);
                                            if(data.results[i]["address_components"][x]["types"][0] == 'country'){
                                                //console.log(data.results[i]["address_components"][x].long_name);
                                                $scope.countries2.push(data.results[i]["address_components"][x].long_name);

                                                //console.log($scope.countries.length);

                                                $scope.counts2 = {};
                                                angular.forEach($scope.countries2, function (value, key){
                                                    if(value in $scope.counts2){
                                                        $scope.counts2[value]++;
                                                    }else{
                                                        $scope.counts2[value] = 1;
                                                    }
                                                });

                                                $scope.contryarray2 = [];
                                                angular.forEach($scope.counts2, function (value, key){
                                                    //var temparr = [];
                                                    //temparr = [{id:key, value:value}];
                                                    var cid = $scope.getcountryid2(key);
                                                    $scope.contryarray2.push({id:cid, value:value});
                                                });

                                                //console.log($scope.contryarray);



                                                FusionCharts.ready(function(){
                                                    var salesByState = new FusionCharts({
                                                        "type": "maps/worldwithcountries",
                                                        "renderAt": "chartContainer2",
                                                        "width": "600",
                                                        "height": "400",
                                                        "dataFormat": "json",
                                                        "dataSource": {
                                                            "chart": {
                                                                "caption": "Criteria Two",
                                                                "subcaption": "Last year",
                                                                "entityFillHoverColor": "#cccccc",
                                                                "numberScaleValue": "1,10,10",
                                                                "showLabels": "0",
                                                                "theme": "fint"
                                                            },
                                                            "colorrange": {
                                                                "color": [
                                                                    {
                                                                        "minvalue": "0",
                                                                        "maxvalue": "24",
                                                                        "code": "#ABEBC6",
                                                                        "displayValue": "Less"
                                                                    },
                                                                    {
                                                                        "minvalue": "25",
                                                                        "maxvalue": "49",
                                                                        "code": "#F39C12",
                                                                        "displayValue": "Okay"
                                                                    },
                                                                    {
                                                                        "minvalue": "50",
                                                                        "maxvalue": "74",
                                                                        "code": "#AF7AC5",
                                                                        "displayValue": "Better"
                                                                    },
                                                                    {
                                                                        "minvalue": "75",
                                                                        "maxvalue": "100",
                                                                        "code": "#E74C3C",
                                                                        "displayValue": "Perfect"
                                                                    }
                                                                ]
                                                            },
                                                            "data":$scope.contryarray2,
                                                        }
                                                    });
                                                    salesByState.render();
                                                });
                                            }
                                        }
                                    }
                                }
                            });


                            var posNeg = simpleCheckPosNeg.getType(response[i]["text"]);
                            posNeg.type.then(function (result) {

                                if(result["score"] >= 0.05 || result["score"] <= -0.05 || result["ratio"] == 1) {

                                    if ($scope.loading) {
                                        $scope.loading = false;
                                    }

                                    if (result["type"] == "positive") {
                                        pos2 += 1;
                                    } else if (result["type"] == "negative") {
                                        neg2 += 1;
                                    }

                                    $scope.positive2 = Math.round(100 * pos2 / (pos2 + neg2));
                                    $scope.negative2 = Math.round(100 * neg2 / (pos2 + neg2));

                                    //pie chart2
                                    $scope.labels2 = ["Good2", "Bad2"];
                                    $scope.data2 = [$scope.positive2, $scope.negative2];
                                    $scope.colors2 = ['#4078a2', '#77c0f8'];
                                    $scope.options2 =  {};

                                    //bar chart good
                                    $scope.barlabels2 = ["One", "Two"];
                                    $scope.bardata2 = [
                                        [$scope.positive, $scope.positive2]
                                    ];
                                    $scope.barcolors2 = ['#4078a2', '#77c0f8'];
                                    $scope.baroptions2 =  {
                                        responsive: true,
                                        maintainAspectRatio: false
                                    }

                                    //bar chart bad
                                    $scope.barlabels = ["One", "Two"];
                                    $scope.bardata = [
                                        [$scope.negative, $scope.negative2]
                                    ];
                                    $scope.barcolors = ['#717984', '#F1C40F'];
                                    $scope.baroptions =  {
                                        responsive: true,
                                        maintainAspectRatio: false
                                    }

                                    count--;
                                }

                                if (i == Math.round(response.length * 20 / 100)) {
                                    maxIDSearch2 = response[response.length - 1];
                                    return setPosNeg2(search, count, $scope);
                                }


                            });

                        })(response, i);
                    }

                } else {
                    console.log("Error in setposneg 2");
                }
            });

        } else {
            return;
        }
    }

    return {
        setPosNeg: function (search, count, $scope) {
            return setPosNeg(search, count, $scope);
        },
        setPosNeg2: function (search, count, $scope) {
            return setPosNeg2(search, count, $scope);
        }
    }
});