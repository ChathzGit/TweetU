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

        $status = $connection->get("users/search", ["q" => $search, "count" => 20]);

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
                        //$temp["createdAt"] = $t->created_at;
                        $temp["location"] = $t->location;
                        $temp["screenName"] = $t->screen_name;
                        $temp["userid"] = 'aa';


                        array_push($arr, $temp);
                }
            }

            array_push($arr, $maxID);
            return json_encode($arr);
        } else {
            $error = array("Error" => "1");
            return json_encode($error);
        }
    }

    public function getSelectedProfileInfo($screenname,$id)
    {


        include_once(app_path() . '/Libraries/twitterOauth/autoload.php');

        $consumer = "YhgNCzaFHgTTPsOyNSdiTR0K0";
        $consumer_secret = "A7LvxyhSDuFOCHwfad7Ki2LKxU2iySOkmzRkq9uNhggUufe2Sw";

        $access_token = "4773766462-qdJnWeDy1LEHW1hVc6loqPDrXViSjVAyWKVFqLG";
        $access_token_secret = "h8ioEfrcTHfmRmEHy4G3Qz3v40dL3FmIX2Iz1MLksnxES";

        $connection = new TwitterOAuth($consumer, $consumer_secret, $access_token, $access_token_secret);
        $content = $connection->get("account/verify_credentials");

        //$status = $connection->get("users/show", ["screen_name" => $screenname,"count" => 20]);

        $status = $connection->get("statuses/user_timeline", ["screen_name" => $screenname,"count" => 20]);

        $arr = array();


        if (!isset($status->error)) {
            foreach ($status as $tweet) {
                foreach ($tweet as $t) {
                    if (isset($t->text)) {

                        array_push($arr, $t->text);
                        break;
                    }
                }
            }
            return view('pages.frontEnd.profiledetails')->with('arr',$arr);
        } else {
            $error = array("Error" => "1");
            return view('pages.frontEnd.profiledetails')->with($error);

        }


    }

}
