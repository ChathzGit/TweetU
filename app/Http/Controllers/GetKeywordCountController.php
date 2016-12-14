<?php
namespace App\Http\Controllers;

use DB;
use App\search;
use App\Http\Controllers\Util\TweetUResponseCode;
use App\SearchLog;
use Unirest\Exception;

class GetKeywordCountController extends Controller
{
    public function getWeeklySearchCount()
    {
        $lastSunday = date("Y-m-d", strtotime('sunday last week'));

        $date_time = new \DateTime($lastSunday);

        //Getting the date from 1 week ago
        $previous_week = $date_time->format('Y-m-d H:i:s');

        //Getting the current date
        $current_date = new \DateTime();

        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {
            $searchLogCountTweets = SearchLog::where('type', '1')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $previous_week)
                ->count();
            $searchLogCountAccounts = SearchLog::where('type', '2')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $previous_week)
                ->count();
            $searchLogCountTopicComparisons = SearchLog::where('type', '3')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $previous_week)
                ->count();
            $searchLogCountAccountComparisons = SearchLog::where('type', '4')
                ->where('timestamp', '<=', $current_date)
                ->where('timestamp', '>=', $previous_week)
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
}