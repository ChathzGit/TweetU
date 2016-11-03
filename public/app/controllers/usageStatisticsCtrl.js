/**
 * Created by Sahan on 11/3/2016.
 */

app.controller('usageStatisticsController', ['$scope', '$http', 'API_URL', '$location', 'toaster', 'searchLogService', 'SUCCESS', 'ERROR',
    function ($scope, $http, API_URL, $location, toaster, searchLogService, SUCCESS, ERROR) {

        $scope.loadUsageData = function () {

            $scope.request = {

            };

            searchLogService.loadUsageStatistics($scope.request, function (response) {

                if (response.status === SUCCESS) {

                    var graphData = [
                        { Type: 'Tweets', value: response.searchLogCountTweets },
                        { Type: 'Accounts', value: response.searchLogCountAccounts },
                        { Type: 'Comparisons', value: response.searchLogCountComparisons }
                    ];

                    drawLineGraph(graphData);
                }

                else if (response.status === ERROR) {
                    toaster.error("Error", response.error);
                }

                else {
                    toaster.error("Error", response.error);
                }


            });
        };


        $scope.loadUsageData();





        function drawLineGraph(graphData)
        {
            new Morris.Bar({
                // ID of the element in which to draw the chart.
                element: 'myfirstchart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: graphData,
                // The name of the data record attribute that contains x-values.
                xkey: 'Type',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['value'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Hits']
            });
        }




    }]);






