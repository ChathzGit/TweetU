<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

/**
 * Class HomePageController
 * @package App\Http\Controllers
 *
 * @author Sahan Munasinghe <munasingheTS93@gmail.com>
 * @version v1.0.0
 */
class AdminHomepageController extends Controller {

	//
    public function index()
    {

        /*
         * This section should only be used if the user is
         * logged in, and has admin privileges
         */
        session_start();

        if( isset($_SESSION['role']) ){

            if($_SESSION['role'] == 'admin')
            {
                return view('pages.backEnd.adminhomepage');
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

}
