<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


/**
 * Class HomePageController
 * @package App\Http\Controllers
 *
 * @author Sahan Munasinghe <munasingheTS93@gmail.com>
 * @version v1.0.0
 * modified by Chathra Senevirathne
 */

class HomePageController extends Controller {

	//
    public function index()
    {
        return view('pages.frontEnd.homepage');
    }

    public function viewAbout()
    {
        return view('about');
    }

}
