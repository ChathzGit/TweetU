<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class LoginController extends Controller {

	//

    public function index()
    {
        return view('pages.frontEnd.userlogin');
    }


    /*
     * This is the function that gets called by the loginService.js
     */
    public  function checkCredentials()
    {


//-------------------------------------------------------------------------------------------------------------------------------

        /*
         * Cartalyst sentinel code is here
         */

        $credentials = [
            'email'    => 'dda@asd.com',
            'password' => 'asdad',
        ];


        $response = Sentinel::authenticate($credentials);

        return json_encode($response);

//-------------------------------------------------------------------------------------------------------------------------------

    }

}
