/**
 * Created by Dhanuka on 11/19/2016.
 *
 * This will create necessary things for twitter analyzing part.
 * Making hash, @users unique unique display manner.
 */

var serviceName = 'settingTopTweetAnalyzer';

app.service(serviceName, function(){

    var settingAnalyzer = function(array, index, result){

        var totalValue = 0;

        var splitText = array[index]["text"].split(" ");

        for(var i = 0; i < splitText.length; i++) {

            if(splitText[i].replace(/[^a-zA-Z]+/g, '').toLowerCase().indexOf("http") >= 0){
                continue;
            }

            var foundedIndex = -1, color = "", str = "", value = 0;

            for (var j = 0; j < result["keywords"].length; j++) {

                if (splitText[i].toLowerCase().indexOf(result["keywords"][j]["word"]) >= 0) {
                    foundedIndex = j;
                }
            }

            if (foundedIndex != -1) {
                if (result["keywords"][foundedIndex]["score"] > 0) {
                    color = "green";
                    str = splitText[i].replace(/[^$#@a-zA-Z0-9.]+/g, '');
                    value = result["keywords"][foundedIndex]["score"];
                } else {
                    color = "red";
                    str = splitText[i].replace(/[^$#@a-zA-Z0-9d*.?d*]+/g, '');
                    value = result["keywords"][foundedIndex]["score"];
                }
            } else {
                color = "black";
                str = splitText[i].replace(/[^$#@a-zA-Z0-9d*.?d*]+/g, '');
            }

            totalValue += value;

            array[index]["analyzed"].push({
                color: color,
                word: str,
                value: value
            });
        }

        array[index]["total"] = (totalValue > 0) ? totalValue : (-1 * totalValue);
    };

    return {
        settingAnalyzer: settingAnalyzer
    };
});
