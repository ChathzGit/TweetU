<?php namespace App\Http\Controllers;

use App\Http\Controllers\Util\TweetUResponseCode;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SearchLog;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Unirest\Exception;

class SearchLogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /*
     * This function checks if there's an active session
     * if there is, it checks if the user logged in is an
     * administrator or a normal user. If it's a normal user,
     * they are redirected to the home page, if they are an
     * administrator user, they are redirected to the admin
     * home page.
     */
    public function loadUsageStatisticsPage()
    {
        session_start();

        if( isset($_SESSION['role']) ){

            if($_SESSION['role'] == 'admin')
            {
                return view('pages.backEnd.adminUsageDetails');
            }

            else
            {
                return view('pages.frontEnd.homepage');
            }

        }

        else
        {
            return view('pages.frontEnd.homepage');
        }


    }


    /*
     * This function loads the search data test interface
     */
    public function loadSearchDataTestDataInterface()
    {

        session_start();

        if( isset($_SESSION['role']) ){

            if($_SESSION['role'] == 'admin')
            {
                return view('pages.backEnd.adminAddSearchLogsTest');
            }

            else
            {
                return view('pages.frontEnd.homepage');
            }

        }

        else
        {
            return view('pages.frontEnd.homepage');
        }



    }


    /*
     * This function gets the search logs, and returns them
     */
    public function getSearchLogs()
    {
        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {
            $searchLogList = SearchLog::where('timestamp', '>=', date('2016-11-12 10:10:00'))
                ->where('timestamp', '<=', '2016-11-25 10:10:00')
                ->get();

            $response = array(
                'status' => $responseCode->success,
                'searchLogList' => $searchLogList
            );

            return json_encode($response);
        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error,
            );

            return json_encode($response);
        }
    }


    /*
     * This function retrieves all the search logs from the database and
     * displays them to the user. All the records from the database.
     */
    public function getAllSearchLogs()
    {

        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {
            $searchLogList = SearchLog::all();
            $response = array(
                'status' => $responseCode->success,
                'searchLogList' => $searchLogList
            );

            return json_encode($response);
        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error,
            );

            return json_encode($response);
        }


    }


    /*
     * This function returns the count of all the search records for each
     * type of search criteria.
     */
    public function getAllSearchLogCount()
    {

        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {
            $searchLogCountTweets = SearchLog::where('type', '1')->count();
            $searchLogCountAccounts = SearchLog::where('type', '2')->count();
            $searchLogCountTopidComparisons = SearchLog::where('type', '3')->count();
            $searchLogCountAccountComparisons = SearchLog::where('type', '4')->count();

            $response = array(
                'status' => $responseCode->success,
                'searchLogCountTweets' => $searchLogCountTweets,
                'searchLogCountAccounts' => $searchLogCountAccounts,
                'searchLogCountTopidComparisons' => $searchLogCountTopidComparisons,
                'searchLogCountAccountComparisons' => $searchLogCountAccountComparisons
            );

            return json_encode($response);

        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error,
            );

            return json_encode($response);
        }
    }


    /*
     * This function returns the search log count for the month.
     */
    public function getMonthlySearchLogCount()
    {
        $date_time = new \DateTime('last month');

        //This gets the date from 30 dates ago
        $last_month = $date_time->format('Y-m-d H:i:s');

        //This gets the current date
        $current_date = new \DateTime();

        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {
            $searchLogCountTweets = SearchLog::where('type', '1')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();
            $searchLogCountAccounts = SearchLog::where('type', '2')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();
            $searchLogCountTopicComparisons = SearchLog::where('type', '3')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();
            $searchLogCountAccountComparisons = SearchLog::where('type', '4')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();

            $response = array(
                'status' => $responseCode->success,
                'searchLogCountTweets' => $searchLogCountTweets,
                'searchLogCountAccounts' => $searchLogCountAccounts,
                'searchLogCountComparisons' => $searchLogCountTopicComparisons,
                'searchLogCountAccountComparisons' => $searchLogCountAccountComparisons
            );

            return json_encode($response);

        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error,
            );

            return json_encode($response);
        }
    }


    /*
     * This function gets the data from the front end and saves
     * the data to the database just when a user conducts a search
     * in the front end. This records the key word, the user id, the type
     * of search and the time stamp.
     */
    public function saveSearchLog(Request $request)
    {
        $searchLog = new SearchLog;

        //$searchLog->user_id = $request->input('userId');
        $searchLog->key_word = $request->input('key_word');
        $searchLog->user_id = $request->input('user_id');
        $searchLog->type = $request->input('type');
        $searchLog->timestamp = date('Y-m-d H:i:s');

        $responseCode = new TweetUResponseCode();

        try {

            if($searchLog->save())
            {
                $response = array(
                    'status' => $responseCode->success
                );
            }
            else {
                $response = array(
                    'status' => $responseCode->error
                );
            }

            return json_encode($response);
        }

        catch (QueryException $e) {

            // Check if the QueryException is an integrity violation
            if ($e->getCode() === '23000') {
                $response = array(
                    'status' => $responseCode->error,
                    'error' => "Duplicate search log",
                    'errordetails' => $e->getMessage()
                );

                return json_encode($response);
            } // Check if the QueryException is any other violation
            else {

                $response = array(
                    'status' => $responseCode->error,
                    'error' => "Error saving search log",
                    'errordetails' => $e->getMessage()
                );

                return json_encode($response);
            }
        }

        // Catch all other exceptions
        catch (Exception $e) {

            $response = array(
                'status' => $responseCode->error,
                'error' => "Error saving search log",
                'errordetails' => $e->getMessage()
            );

            return json_encode($response);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //


    }


    /*
     * This function gets the percentage changes.
     * This is done by getting the searchlog count from
     * the database for this month (last thirty days) and the
     * month before that, and comparing the two to get the
     * increase or decrease of progress.
     */
    public function getPercentageChanges()
    {
        $date_time = new \DateTime('last month');
        $last_month = $date_time->format('Y-m-d H:i:s');

        $current_date = new \DateTime();
        $prev_month = date('Y-m-d H:i:s',strtotime($last_month.' last month'));
        //return json_encode(Date('Y-m-d H:i:s', strtotime($last_month)));


        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {

            /*
             * Tweet analysis count*/
            $TweetsThisMonth = SearchLog::where('type', '1')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();

            $TweetsLastMonth = SearchLog::where('type', '1')
                ->where('timestamp', '<=', $last_month)
                ->where('timestamp', '>=', $prev_month)
                ->count();

            $TotalTweets = SearchLog::where('type', '1')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $prev_month)
                ->count();

            /*
             * Account analysis count
             */
            $AccountsThisMonth = SearchLog::where('type', '2')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();

            $AccountsLastMonth = SearchLog::where('type', '2')
                ->where('timestamp', '<=', $last_month)
                ->where('timestamp', '>=', $prev_month)
                ->count();

            $TotalAccounts = SearchLog::where('type', '2')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $prev_month)
                ->count();



            /*
             * Topic Comparisons count
             */
            $TopicComparisonsThisMonth = SearchLog::where('type', '3')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();

            $TopicComparisonsLastMonth = SearchLog::where('type', '3')
                ->where('timestamp', '<=', $last_month)
                ->where('timestamp', '>=', $prev_month)
                ->count();

            $TopicTotalComparisons = SearchLog::where('type', '3')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $prev_month)
                ->count();


            /*
             * Account Comparisons count
             */
            $AccountComparisonsThisMonth = SearchLog::where('type', '4')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $last_month)
                ->count();

            $AccountComparisonsLastMonth = SearchLog::where('type', '4')
                ->where('timestamp', '<=', $last_month)
                ->where('timestamp', '>=', $prev_month)
                ->count();

            $AccountTotalComparisons = SearchLog::where('type', '4')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $prev_month)
                ->count();






            if($TweetsThisMonth > 0 && $TweetsLastMonth>0) {
                $TweetPercentage = (($TweetsThisMonth / $TweetsLastMonth) * 100);
                if ($TweetPercentage < 100) {
                    $TweetPercentage = round((100 - $TweetPercentage), 2);
                }
            }
            else
            {
                $TweetPercentage = 0;
            }

            if($AccountsThisMonth > 0 && $AccountsLastMonth>0) {
                $AccountPercentage = ($AccountsThisMonth / $AccountsLastMonth * 100);
                if ($AccountPercentage < 100) {
                    $AccountPercentage = round((100 - $AccountPercentage), 2);
                }

            }
            else
            {
                $AccountPercentage = 0;
            }

            if($TopicComparisonsThisMonth > 0 && $TopicComparisonsLastMonth>0) {
                $TopicComparisonPercentage = ($TopicComparisonsThisMonth / $TopicComparisonsLastMonth * 100);
                if ($TopicComparisonPercentage < 100) {
                    $TopicComparisonPercentage = round((100 - $TopicComparisonPercentage), 2);
                }
            }
            else
            {
                $TopicComparisonPercentage = 0;
            }


            if($AccountComparisonsThisMonth > 0 && $AccountComparisonsLastMonth>0) {
                $AccountComparisonPercentage = ($AccountComparisonsThisMonth / $AccountComparisonsLastMonth * 100);
                if ($AccountComparisonPercentage < 100) {
                    $AccountComparisonPercentage = round((100 - $AccountComparisonPercentage), 2);
                }
            }
            else
            {
                $AccountComparisonPercentage = 0;
            }



            $response = array(
                'status' => $responseCode->success,

                'TweetsThisMonth' => $TweetsThisMonth,
                'TweetsLastMonth' => $TweetsLastMonth,
                'TotalTweets' => $TotalTweets,
                'TweetPercentage' => $TweetPercentage,

                'AccountsThisMonth' => $AccountsThisMonth,
                'AccountsLastMonth' => $AccountsLastMonth,
                'TotalAccounts' => $TotalAccounts,
                'AccountPercentage' => $AccountPercentage,

                'TopicComparisonsThisMonth' => $TopicComparisonsThisMonth,
                'TopicComparisonsLastMonth' => $TopicComparisonsLastMonth,
                'TopicTotalComparisons' => $TopicTotalComparisons,
                'TopicComparisonPercentage' => $TopicComparisonPercentage,

                'AccountComparisonsThisMonth' => $AccountComparisonsThisMonth,
                'AccountComparisonsLastMonth' => $AccountComparisonsLastMonth,
                'AccountTotalComparisons' => $AccountTotalComparisons,
                'AccountComparisonPercentage' => $AccountComparisonPercentage
            );

            return json_encode($response);

        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error,
            );

            return json_encode($response);
        }
    }







}

