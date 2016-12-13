<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use Abraham\TwitterOAuth\TwitterOAuth;

class ProfileController extends Controller {

    //
    public function __construct()
    {
        $this->middleware('guest');
    }



    public function index()
    {
        return view('Profiles');
    }

    public function viewProfileCompair()
    {
        return view('pages.frontEnd.profileCompair');
    }



    public function getProfiles()
    {
        $search = Input::get('search');
        $maxID = Input::get('maxID');
        $isRecent = Input::get('recent');

        include_once(app_path() . '/Libraries/twitterOauth/autoload.php');

        $consumer = "YhgNCzaFHgTTPsOyNSdiTR0K0";
        $consumer_secret = "A7LvxyhSDuFOCHwfad7Ki2LKxU2iySOkmzRkq9uNhggUufe2Sw";

        $access_token = "4773766462-qdJnWeDy1LEHW1hVc6loqPDrXViSjVAyWKVFqLG";
        $access_token_secret = "h8ioEfrcTHfmRmEHy4G3Qz3v40dL3FmIX2Iz1MLksnxES";

        $connection = new TwitterOAuth($consumer, $consumer_secret, $access_token, $access_token_secret);
        $content = $connection->get("account/verify_credentials");

        $status = $connection->get("users/search", ["q" => $search, "count" => 20, "include_entities" => true]);

        $arr = array();

        if (!isset($status->error)) {
            foreach ($status as $t) {
                if (isset($t->name)) {

                    $temp = array();
                    $temp["name"] = $t->name;
                    $temp["url"] = $t->profile_image_url;
                    $temp["verify"] = $t->verified;
                    $temp["followersCount"] = $t->followers_count;
                    $temp["description"] = $t->description;
                    $temp["createdAt"] = $t->created_at;
                    $temp["favouritesCount"] = $t->favourites_count;
                    $temp["friendsCount"] = $t->friends_count;

                    $cdate = strtotime($t->created_at);
                    $created_date = date('Y-m-d',$cdate);
                    $temp["createdAt"] = $created_date;

                    $now = date("Y-m-d");

                    $date1=date_create($created_date);
                    $date2=date_create($now);

                    $diff=date_diff($date1,$date2);

                    $temp["datecount"] = $diff->format("%a");
                    $temp["tweetsperday"] = $t->statuses_count/$diff->format("%a");

                    $temp["location"] = $t->location;
                    $temp["screenName"] = $t->screen_name;
                    $temp["tweetcount"] = $t->statuses_count;
                    //$temp["rc"] = $t->entities->description->urls;


                    array_push($arr, $temp);
                }
            }

            return json_encode($arr);
        } else {
            $error = array("Error" => "1");
            return json_encode($error);
        }
    }

    public function getProfileTweets()
    {

        $screenName = Input::get('screenName');

        include_once(app_path() . '/Libraries/twitterOauth/autoload.php');

        $consumer = "YhgNCzaFHgTTPsOyNSdiTR0K0";
        $consumer_secret = "A7LvxyhSDuFOCHwfad7Ki2LKxU2iySOkmzRkq9uNhggUufe2Sw";

        $access_token = "4773766462-qdJnWeDy1LEHW1hVc6loqPDrXViSjVAyWKVFqLG";
        $access_token_secret = "h8ioEfrcTHfmRmEHy4G3Qz3v40dL3FmIX2Iz1MLksnxES";

        $connection = new TwitterOAuth($consumer, $consumer_secret, $access_token, $access_token_secret);
        $content = $connection->get("account/verify_credentials");

        //$status = $connection->get("users/show", ["screen_name" => $screenname,"count" => 20]);

        $status = $connection->get("statuses/user_timeline", ["screen_name" => $screenName,"count" => 20, "include_entities" => true]);

        $arr = array();

        if (!isset($status->error)) {
            foreach ($status as $tweet) {
                foreach ($tweet as $t) {
                    if (isset($t->text)) {

                        $temp = array();
                        $temp["text"] = $t->text;
                        array_push($arr, $temp);
                    }
                }
            }
            return json_encode($arr);

        }else {
            $error = array("Error" => "1");
            return json_encode($error);
        }


    }

    public function getProfileTweetsInfo()
    {
        $maxID = -1;
        $screenName = Input::get('screenName');

        $arr = array();
        $retweetarray = array();
        $hashtags = array();
        $usermentions = array();
        $totalRetweetCount = 0;

        include_once(app_path() . '/Libraries/twitterOauth/autoload.php');

        $consumer = "YhgNCzaFHgTTPsOyNSdiTR0K0";
        $consumer_secret = "A7LvxyhSDuFOCHwfad7Ki2LKxU2iySOkmzRkq9uNhggUufe2Sw";

        $access_token = "4773766462-qdJnWeDy1LEHW1hVc6loqPDrXViSjVAyWKVFqLG";
        $access_token_secret = "h8ioEfrcTHfmRmEHy4G3Qz3v40dL3FmIX2Iz1MLksnxES";

        $connection = new TwitterOAuth($consumer, $consumer_secret, $access_token, $access_token_secret);
        $content = $connection->get("account/verify_credentials");

        for($i = 0;$i<(10);$i++)
        {
            if ($maxID == -1)
            {
                $status = $connection->get("statuses/user_timeline", ["screen_name" => $screenName,"count" => 20, "include_entities" => true]);

            }
            else
            {
                $status = $connection->get("statuses/user_timeline", ["screen_name" => $screenName,"count" => 20, "include_entities" => true,"max_id" => $maxID]);
            }


            if (!isset($status->error)) {
                foreach ($status as $tweet) {
                    foreach ($tweet as $t) {
                        if (isset($t->text)) {

                            $temp = array();
                            $temp["text"] = $t->text;
                            $temp["retweetcount"]=$t->retweet_count;
                            $retweetarray[$t->text] =$t->retweet_count;
                            $totalRetweetCount = $totalRetweetCount+$t->retweet_count;
                            array_push($arr, $temp);
                            array_push($hashtags,$t->entities->hashtags);
                            array_push($usermentions,$t->entities->user_mentions);

                            if ($maxID == -1 || $maxID > ($t->id)) {
                                $maxID = $t->id;
                            }
                        }
                    }
                }


            }else {
                $error = array("Error" => "1");
                //return json_encode($error);
            }


        }


        //get all the hash tags into single array
        $hashtagsArray = array();
        for($i=0; $i<count($hashtags); $i++){
            for($p=0; $p<count($hashtags[$i]); $p++){
                array_push($hashtagsArray,$hashtags[$i][$p]->text);
            }
        }

        //get all the user mentions into single array
        $mentionArray = array();
        for($i=0; $i<count($usermentions); $i++){
            for($p=0; $p<count($usermentions[$i]); $p++){
                array_push($mentionArray,$usermentions[$i][$p]->name);
            }
        }



        //get count of all hash tags
        $hashtagsResults = array();
        $hashtagsResults = array_count_values($hashtagsArray);

        //get count of all user mentions
        $mentionResults = array();
        $mentionResults = array_count_values($mentionArray);

        //sort arrays by descending order and get top 10 values
        arsort($mentionResults);
        $mentionResults = array_slice($mentionResults, 0, 10);

        arsort($hashtagsResults);
        $hashtagsResults = array_slice($hashtagsResults, 0, 10);

        //most re tweeted tweets
        arsort($retweetarray);
        $retweetarray = array_slice($retweetarray, 0, 5);

        return json_encode(['userMentions'=>$mentionResults,'hashtags'=>$hashtagsResults,'retweets'=>$retweetarray]);
        //return $hashtagsResults;

        // return $usermentions;
    }

    public function GetUserLocations()
    {
        $screenName = Input::get('screenName');


        $maxID =Input::get('maxid');

        $locations = array();


        include_once(app_path() . '/Libraries/twitterOauth/autoload.php');

        $consumer = "YhgNCzaFHgTTPsOyNSdiTR0K0";
        $consumer_secret = "A7LvxyhSDuFOCHwfad7Ki2LKxU2iySOkmzRkq9uNhggUufe2Sw";

        $access_token = "4773766462-qdJnWeDy1LEHW1hVc6loqPDrXViSjVAyWKVFqLG";
        $access_token_secret = "h8ioEfrcTHfmRmEHy4G3Qz3v40dL3FmIX2Iz1MLksnxES";

        $connection = new TwitterOAuth($consumer, $consumer_secret, $access_token, $access_token_secret);
        $content = $connection->get("account/verify_credentials");

        if ($maxID == -1) {
            $status2 = $connection->get("followers/list", ["screen_name" => $screenName, "count" => 200]);

        } else {
            $status2 = $connection->get("followers/list", ["screen_name" => $screenName, "count" => 200, "include_entities" => true, "cursor" => $maxID]);
        }


        if (!isset($status2->error)) {

            $maxID = $status2->next_cursor_str;
            foreach ($status2->users as $tweet2) {

                if($tweet2->location!="") {
                    array_push($locations, $tweet2->location);
                }

            }
            array_push($locations, $maxID);
            //}
            return json_encode($locations);

        }else {
            $error = array("Error" => "1");
            return json_encode($error);
            //return json_encode($error);
        }


//        //get count of all locations
//        $locationResults = array();
//        $locationResults = array_count_values($locations);


    }




}

