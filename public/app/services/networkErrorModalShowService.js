/**
 * Created by ACer on 10/28/2016.
 *
 * This service will set the appropriate options to handle the error model
 *
 * template(templateUrl) can be found inside the html page of caller controller
 */

app.service("settingError", function($modal){

    var networkError = function(){
        $modal.open({
            templateUrl: 'NetworkError.html',
            backdrop: 'static',
            keyboard: false
        });
    };

    return {
        networkError: networkError
    };
});