<?php
namespace App\Http\Controllers;
/**
 * Dhanuka Anjana
 * dhanu.anjana.93@gmail.com
 */
use Abraham\TwitterOAuth\TwitterOAuth;
use Input;

class TweetComparisonController extends Controller{

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index()
	{
		return view('tweetcomparison');
	}

	/**@param search
	 * search string need to be search using twitter api
	 *
	 * @param maxID
	 * In the first request it will get -1, to identify as it's the first call from client end
	 * After that it will values of the previous request minimum value
	 *
	 * @return json
	 * if success tweet comments, else error message
	 *
	 * This function will call the twitter api and get recent search results.
	 * Using the maxID this when requesting from the twitter get an single flow of tweets one after the other.
	 */
	public function getTweets()
	{
		try {
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

			if($isRecent == 1) {
				if ($maxID == -1) {
					$status = $connection->get("search/tweets", ["q" => $search, "count" => 500, "result_type" => "recent", "lang" => "en", "include_entities" => true]);
				} else {
					$status = $connection->get("search/tweets", ["q" => $search, "count" => 500, "result_type" => "recent", "lang" => "en", "max_id" => $maxID, "include_entities" => true]);
				}
			} else {
				if ($maxID == -1) {
					$status = $connection->get("search/tweets", ["q" => $search, "count" => 500, "result_type" => "popular", "lang" => "en", "include_entities" => true]);
				} else {
					$status = $connection->get("search/tweets", ["q" => $search, "count" => 500, "result_type" => "popular", "lang" => "en", "max_id" => $maxID, "include_entities" => true]);
				}
			}


			$arr = array();

			if (!isset($status->error)) {
				foreach ($status as $tweet) {
					foreach ($tweet as $t) {
						if (isset($t->text)) {

							$singleTweet = array();

							if($isRecent == 0) {

								$singleTweet["text"] = htmlspecialchars_decode($t->text);
								$singleTweet["retweet"] = $t->retweet_count;
								$singleTweet["user"] = $t->user->name;
								$singleTweet["id"] = $t->id;
								$singleTweet["createdat"] = $t->created_at;


							} else {
								$singleTweet["text"] = htmlspecialchars_decode($t->text);
								$singleTweet["user"] = $t->user->name;
								$singleTweet["tweeterslocation"] = $t->user->location;
								$singleTweet["id"] = $t->id;
								$singleTweet["createdat"] = $t->created_at;
							}

							array_push($arr, $singleTweet);
						}
					}
				}

				array_push($arr, $status->search_metadata->max_id_str);
				return json_encode($arr);
			} else {
				$error = array("Error" => "1");
				return json_encode($error);
			}
		}
		catch(\Exception $e)
		{
			$error = array("Error" => "1", "Error_Type" => $e->getMessage());
			return json_encode($error);
		}
	}

	/**
	 * Get oembed tweets
	 */
	public function getOmbeds(){

		include_once(app_path() . '/Libraries/twitterOauth/autoload.php');

		$consumer = "YhgNCzaFHgTTPsOyNSdiTR0K0";
		$consumer_secret = "A7LvxyhSDuFOCHwfad7Ki2LKxU2iySOkmzRkq9uNhggUufe2Sw";

		$access_token = "4773766462-qdJnWeDy1LEHW1hVc6loqPDrXViSjVAyWKVFqLG";
		$access_token_secret = "h8ioEfrcTHfmRmEHy4G3Qz3v40dL3FmIX2Iz1MLksnxES";

		$connection = new TwitterOAuth($consumer, $consumer_secret, $access_token, $access_token_secret);
		$content = $connection->get("account/verify_credentials");

		$oembed = $connection->get("statuses/oembed", ["id" => '796938009853722624']);

		return ($oembed->html);

	}

	/**
	 * For the moment not using this function :D
	 */
	public function getPositiveNegative()
	{
		$sentences = json_decode(Input::get('sentences'));

//        include_once(app_path() . '/Libraries/unirest-php-master/src/Unirest.php');
//        Unirest\Request::verifyPeer(false);
//        include_once(app_path() . '/Libraries/php -fast-cache/autoload.php');
//        $cache = phpFastCache();

		$type = array();
		$type["positive"] = 0;
		$type["negative"] = 0;

//        $cache->set("Type", $type, 0);
//        $pidSet = array();

		$curlInit = array();
		$curlMultiInit = curl_multi_init();

		foreach($sentences as $msg) {
			$curlInit[sizeof($curlInit)] = curl_init("https://twinword-sentiment-analysis.p.mashape.com/analyze/?text=" . urlencode($msg));

			curl_setopt($curlInit[sizeof($curlInit) - 1], CURLOPT_HTTPHEADER, array(
					'Accept: application/json',
					'X-Mashape-Key : oVVThH3Bx3mshNlYP5WiIGnDeU5jp1HRjtBjsnZHTg04DEParE'
				)
			);
			curl_setopt($curlInit[sizeof($curlInit) - 1], CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlInit[sizeof($curlInit) - 1], CURLOPT_SSL_VERIFYPEER, false);

			curl_multi_add_handle($curlMultiInit,$curlInit[sizeof($curlInit) - 1]);

//            $pid = pcntl_fork();
//
//            if($pid <= 0) {
//                $response = Unirest\Request::get("https://twinword-sentiment-analysis.p.mashape.com/analyze/?text=" . urlencode($msg),
//                    array(
//                        "X-Mashape-Key" => "oVVThH3Bx3mshNlYP5WiIGnDeU5jp1HRjtBjsnZHTg04DEParE",
//                        "Accept" => "application/json"
//                    )
//                );
//
//                $typeArray = $cache->get("Type");
//
//                if (json_decode($response->raw_body, true)["type"] == "positive") {
//                    $typeArray["positive"]++;
//                } else if (json_decode($response->raw_body, true)["type"] == "negative") {
//                    $typeArray["negative"]++;
//                }
//                exit(0);
//            }
//
//            if($pid > 0) {
//                $pidSet[$pid] = $pid;
//            }
		}

//        foreach ($pidSet as $pids) {
//            pcntl_waitpid($pids, $status);
//            unset($pidSet[$pids]);
//        }
//
//        echo json_encode($cache->get("Type"));
//        $cache->delete("Type");

		$running = null;
		do {
			curl_multi_exec($curlMultiInit, $running);
		} while ($running);

		for($i = 0; $i < sizeof($sentences); $i++){
			$response = curl_multi_getcontent($curlInit[$i]);
			if(json_decode($response, true)["type"] == "positive"){
				$type["positive"]++;
			} else if(json_decode($response, true)["type"] == "negative"){
				$type["negative"]++;
			}
		}

		echo json_encode($type);

		for($i = 0; $i < sizeof($sentences); $i++){
			curl_multi_remove_handle($curlMultiInit, $curlInit[$i]);
		}
		curl_multi_close($curlMultiInit);
	}


}