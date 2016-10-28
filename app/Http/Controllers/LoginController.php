<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util\TweetUResponseCode;

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Unirest\Exception;

class LoginController extends Controller {

	//

    public function index()
    {
        return view('pages.frontEnd.userlogin');
    }


    /*
     * This is the function that gets called by the loginService.js
     */
    public function checkCredentials(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $responseCode = new TweetUResponseCode();

        $user = new User;


        try{

            $user = User::where('email', $email)
                ->get()->first();

            if($user !== null)
            {
                $user = User::where('email', $email)
                    ->where('password', $password)
                    ->get()->first();



                if($user !== null)
                {
                    $response = array(
                        'status' => $responseCode->success,
                        'email' => $user->email,
                        'username' => $user->name
                    );

                    return json_encode($response);
                }

                else{
                    $response = array(
                        'status' => $responseCode->error,
                        'error' => "Wrong password"
                    );

                    return json_encode($response);
                }
            }

            else
            {
                $response = array(
                    'status' => $responseCode->error,
                    'error' => "User not found"
                );

                return json_encode($response);
            }


        }

        catch(Exception $e)
        {
            $response = array(
                'status' => $responseCode->error,
                'error' => $e
            );

            return json_encode($response);
        }

        
    }

}
