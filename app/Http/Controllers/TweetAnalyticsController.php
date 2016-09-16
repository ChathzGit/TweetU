<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


/**
 * Class TweetAnalyticsController
 * @package App\Http\Controllers
 *
 * @author Sahan Munasinghe <munasingheTS93@gmail.com>
 * @version v1.0.0
 */
class TweetAnalyticsController extends Controller {

	//
	public function index()
	{
		return view('pages.tweetanalytics');
	}

}
