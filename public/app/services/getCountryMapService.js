/**
 * Created by ACer on 10/28/2016.
 */

app.service("setCountry", function ($http, $q) {

    var getCountry = function (location) {

        var canceller = $q.defer();

        var cancelMapping = function (reason) {
            canceller.resolve(reason);
        };

        var code = $http.get("https://maps.googleapis.com/maps/api/geocode/json?address=" + location + "&key=AIzaSyAwBbTy5kYbeQZY-jBpN9HyOfMW61BLcxI",
            {
                timeout: canceller.promise
            }).then(function (response) {
            return response.data;
        });

        var countryCodeList = function (country_name) {
            if (country_name == 'Afghanistan') {
                return '93';
            } else if (country_name == 'Albania') {
                return '120';
            } else if (country_name == 'Argentina') {
                return '25';
            } else if (country_name == '') {
                return '';
            } else if (country_name == 'Australia') {
                return '175';
            } else if (country_name == 'Austria') {
                return '131';
            } else if (country_name == 'Bangladesh') {
                return '96';
            } else if (country_name == 'Belgium') {
                return '133';
            } else if (country_name == 'Bolivia') {
                return '26';
            } else if (country_name == 'Brazil') {
                return '27';
            } else if (country_name == 'Cambodia') {
                return '100';
            } else if (country_name == 'Canada') {
                return '05';
            } else if (country_name == 'Chile') {
                return '28';
            } else if (country_name == 'China') {
                return '101';
            } else if (country_name == 'Colombia') {
                return '29';
            } else if (country_name == 'Egypt') {
                return '53';
            } else if (country_name == 'France') {
                return '141';
            } else if (country_name == 'Georgia') {
                return '103';
            } else if (country_name == 'Germany') {
                return '142';
            } else if (country_name == 'Greece') {
                return '143';
            } else if (country_name == 'Greenland') {
                return '24';
            } else if (country_name == '	Haiti') {
                return '13';
            } else if (country_name == 'Hong Kong') {
                return '127';
            } else if (country_name == 'Iceland') {
                return '145';
            } else if (country_name == 'India') {
                return '104';
            } else if (country_name == 'Indonesia') {
                return '105';
            } else if (country_name == 'Iran') {
                return '106';
            } else if (country_name == 'Iraq') {
                return '191';
            } else if (country_name == 'Ireland') {
                return '146';
            } else if (country_name == 'Israel') {
                return '192';
            } else if (country_name == 'Italy') {
                return '147';
            } else if (country_name == 'Jamaica') {
                return '15';
            } else if (country_name == 'Japan') {
                return '107';
            } else if (country_name == 'Jordan') {
                return '193';
            } else if (country_name == 'Kazakhstan') {
                return '108';
            } else if (country_name == 'North Korea') {
                return '109';
            } else if (country_name == 'South Korea') {
                return '110';
            } else if (country_name == 'Lebanon') {
                return '195';
            } else if (country_name == 'Liberia') {
                return '63';
            } else if (country_name == 'Libya') {
                return '64';
            } else if (country_name == 'Luxembourg') {
                return '151';
            } else if (country_name == 'Madagascar') {
                return '65';
            } else if (country_name == 'Malta') {
                return '153';
            } else if (country_name == 'Mauritius') {
                return '92';
            } else if (country_name == 'Mexico') {
                return '16';
            } else if (country_name == 'Netherlands') {
                return '157';
            } else if (country_name == 'New Zealand') {
                return '181';
            } else if (country_name == 'Norway') {
                return '158';
            } else if (country_name == 'Pakistan') {
                return '116';
            } else if (country_name == 'Philippines') {
                return '117';
            } else if (country_name == 'Poland') {
                return '159';
            } else if (country_name == 'Russia') {
                return '118';
            } else if (country_name == 'Romania') {
                return '161';
            } else if (country_name == 'Saudi Arabia') {
                return '198';
            } else if (country_name == 'South Africa') {
                return '80';
            } else if (country_name == 'Spain') {
                return '166';
            } else if (country_name == 'Sri Lanka') {
                return '120';
            } else if (country_name == 'Sweden') {
                return '167';
            } else if (country_name == 'Switzerland') {
                return '168';
            } else if (country_name == 'Syria') {
                return '199';
            } else if (country_name == 'Taiwan') {
                return '126';
            } else if (country_name == 'Thailand') {
                return '122';
            } else if (country_name == 'Turkey') {
                return '173';
            } else if (country_name == 'Uganda') {
                return '86';
            } else if (country_name == 'Ukraine') {
                return '169';
            } else if (country_name == 'United Arab Emirates') {
                return '200';
            } else if (country_name == 'United Kingdom') {
                return '170';
            } else if (country_name == 'United States') {
                return '23';
            } else if (country_name == 'Uzbekistan') {
                return '124';
            } else if (country_name == 'Venezuela') {
                return '38';
            } else if (country_name == 'Vietnam') {
                return '125';
            } else {
                return '0';
            }
        };

        return {
            code: code,
            countryCodeList: countryCodeList,
            cancelMapping: cancelMapping
        };
    };

    return {
        getCountry: getCountry
    };

});