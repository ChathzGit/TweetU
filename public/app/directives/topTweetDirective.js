/**
 * Created by ACer on 10/28/2016.
 */


app.directive('topTweet', function ($compile) {
    return {
        scope: {
            tweet: '=tweet'
        },
        controller: function($scope, $element) {

            var ele = $compile( "<div style='word-wrap: break-word'></div>" )( $scope );
            var currentTypingLabel = $compile( "<span style='font-weight: bold;' ></span>" )( $scope );

            var tweetTxt = $scope.tweet.split(" ");
            var previousSpecialDetail = false;

            for(var i = 0; i < tweetTxt.length; i++){
                if(tweetTxt[i][0] == "@" || tweetTxt[i][0] == "#"){
                    var userAccount;
                    if(tweetTxt[i][0] == "#") {

                        userAccount = [];

                        var replacingString = tweetTxt[i].replace("#", ",%.%#")

                        var hashTags = replacingString.split(",%.%");
                        for(var j = 0; j < hashTags.length; j++){

                            var word = hashTags[j].substring(1);
                            if(/^[a-zA-Z0-9]+$/.test(word)) {
                                userAccount[j] = $compile('<span ng-click="$parent.newSearch(\'' + hashTags[j] + '\')" style="text-decoration: underline; color: blue; cursor:pointer; font-weight: bold;">' + hashTags[j] + '</span>')($scope);
                            } else {
                                var lastLetterIndex = 0;
                                for(var k = 0; k < word.length; k++){
                                    if(!(/^[a-zA-Z0-9]/.test(word[k]))){
                                        lastLetterIndex = k;
                                        break;
                                    }
                                }

                                if(lastLetterIndex != 0) {
                                    userAccount[j] = $compile(
                                        '<span ng-click="$parent.newSearch(\'' + hashTags[j].substring(0, lastLetterIndex + 1) + '\')" style="text-decoration: underline; color: blue; cursor:pointer; font-weight: bold;">' + hashTags[j].substring(0, lastLetterIndex + 1) + '</span>' +
                                        '<span>' + hashTags[j].substring(lastLetterIndex + 1) + '</span>'
                                    )($scope);
                                } else {
                                    userAccount[j] = $compile(
                                        '<span>' + hashTags[j] + '</span>'
                                    )($scope);
                                }
                            }
                        }

                    } else {
                        userAccount = $compile('<span style="color: blue; text-decoration: underline; cursor:pointer; font-weight: bold;">' + tweetTxt[i] + '</span>')($scope);
                    }

                    ele.append(userAccount);
                    previousSpecialDetail = true;
                } else {
                    if(previousSpecialDetail && currentTypingLabel.text() != ""){
                        previousSpecialDetail = false;
                        ele.append(currentTypingLabel);
                        currentTypingLabel = $compile( "<span style='font-weight: bold;'></span>" )( $scope );
                        currentTypingLabel.text(" " + tweetTxt[i] + " ");
                    } else {
                        currentTypingLabel.text(" " + currentTypingLabel.text() + tweetTxt[i] + " ");
                    }
                }
            }

            ele.append(currentTypingLabel);
            $element.append(ele);
        }
    }
});
