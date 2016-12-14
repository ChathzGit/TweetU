{{--
--
-- Author -
-- Version - v1.0.0
--
-- This is the word cloud and weekly usage page
--
--}}

@extends('pages.adminIndex')

@section('content')

    <style type="text/css">
        #tagcloud {
            width: 950px;
            background:#CFE3FF;
            color:#0066FF;
            padding: 10px;
            border: 1px solid #559DFF;
            text-align:center;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }

        #tagcloud a:link, #tagcloud a:visited {
            text-decoration:none;
            color: #333;
        }

        #tagcloud label:hover {
            text-decoration: underline;
        }

        #tagcloud span {
            padding: 4px;
        }

        #tagcloud .smallest {
            font-size:xx-small;
        }

        #tagcloud .smaller {
            font-size:x-small;
        }

        #tagcloud .small {
            font-size:small;
        }

        #tagcloud .medium {
            font-size:medium;
        }

        #tagcloud .large {
            font-size:large;
        }

        #tagcloud .larger {
            font-size:x-large;
        }

        #tagcloud .largest {
            font-size:xx-large;
        }

        .showmeonhover {
            display: none;

            width: 120px;
            background-color: darkblue;
            color: deepskyblue;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the hover item */
            position: absolute;
            z-index: 1;
        }

        .alwaysshowme:hover .showmeonhover {
            display: inline;
        }

    </style>



    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div id="weeklyGraph">

                    <h1 class="page-header">Tweet About Site</h1>

                    <form id="tweets" method="get" action="send-tweets" target="formSending">
                        <input type="text" name="nnn" id="nnn" />
                        <input type="submit" name="submit" id="submit" value="Submit" />
                    </form>

                </div>

                <iframe name="formSending" hidden></iframe>


                <hr>

                <h1 class="page-header">Popular Searches</h1>

                    <div id="tagcloud" class="col-sm-12 col-xs-12">

                        <?php
                            // start looping through the tags
                            foreach ($terms as $term):
                                // determine the popularity of this term as a percentage
                                $percent = floor(($term['counter'] / $maximum) * 100);

                                // determine the class for this term based on the percentage
                                if ($percent < 30):
                                    $class = 'small';
                                elseif ($percent >= 30 and $percent < 50):
                                    $class = 'medium';
                                elseif ($percent >= 50 and $percent < 70):
                                    $class = 'larger';
                                else:
                                    $class = 'largest';
                                endif;
                        ?>

                        <span class="<?php echo $class; ?> alwaysshowme">
                            <label>
                                <?php echo $term['term']; ?>
                                <span class="showmeonhover"><?php echo $term['counter']; ?></span>
                            </label>
                        </span>

                            <?php endforeach; ?>

                        </div>
                <hr>

                <div class="col-sm-12 col-xs-12">
                    <h1 class="page-header">Site Usage Statistics of This Week</h1>
                    <h5>The number of times each service was used from last Sunday to now</h5>
                </div>

                <?php
                    $urlThing = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $cutURL =  substr($urlThing, 0, (strlen($urlThing) - 10));
                    $json = file_get_contents($cutURL . "keyword-count"); // this WILL do an http request for you
                    $data = json_decode($json);

                    $TweetAnalysisCount = $data->{'searchLogCountTweets'};
                    $AccountAnalysisCount = $data->{'searchLogCountAccounts'};
                    $TopicComparisonsCount = $data->{'searchLogCountComparisons'};
                    $AccountComparisonsCount = $data->{'searchLogCountAccountComparisons'};
                ?>


                <div class="col-sm-2"></div>
                <div class="col-sm-8 col-xs-12" id="weeklyGraph" style="height: 500px;">

                    <div class="col-sm-12 col-xs-12 p-0">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8 col-xs-12">
                            <canvas id="myChart" width="50px" height="50px"></canvas>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
                    <script>

                        var TweetAnalysisCount = "<?php echo $TweetAnalysisCount; ?>";
                        var AccountAnalysisCount ="<?php echo $AccountAnalysisCount; ?>";
                        var TopicComparisonsCount ="<?php echo $TopicComparisonsCount; ?>";
                        var AccountComparisonsCount ="<?php echo $AccountComparisonsCount; ?>";

                        var ctx = document.getElementById("myChart");
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ["Tweet Analysis", "Account Analysis", "Topic Comparisons", "Account Comparisons"],
                                datasets: [{
                                    label: '# of Votes',
                                    data: [TweetAnalysisCount, AccountAnalysisCount, TopicComparisonsCount, AccountComparisonsCount],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(255,99,132,1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(153, 102, 255, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            }
                        });
                    </script>

                </div>

                <div class="col-sm-2"></div>

            </div>
        </div>

    </div>

@stop