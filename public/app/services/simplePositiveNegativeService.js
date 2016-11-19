/**
 * Created by ACer on 11/19/2016.
 */

app.service("simpleCheckPosNeg", function($http, $q) {

    var getType = function (search) {

        var canceller = $q.defer();

        var cancelChecker = function (reason) {
            canceller.resolve(reason);
        };

        var type = $http.get("https://twinword-sentiment-analysis.p.mashape.com/analyze/", {
            headers: {
                'X-Mashape-Key': 'ojF8QuQu1ZmshWjxUrOGDmm5iuV2p1S2cpwjsnmHgOkkAsMmzO',
                'Accept': 'application/json'
            },
            params: {text: search},
            timeout: canceller.promise
        }).then(function (response) {
            return response.data;
        });

        return {
            type: type,
            cancelChecker: cancelChecker
        };
    };

    return {
        getType: getType
    };

});