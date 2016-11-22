/**
 * Created by ACer on 10/28/2016.
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