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

        /*
         * Get the data coming form the request
         * and assign them to local variables
         */
        $email = $request->input('email');
        $password = $request->input('password');

        // The codes used to send the response status
        $responseCode = new TweetUResponseCode();

        // Declare a user
        $user = new User;


        try{

            // Instantiate the user if it exists in the database
            $user = User::where('email', $email)
                ->get()->first();

            // Check if the user exists
            if($user !== null)
            {
                /*
                 * The secondary search only happens if the user exists.
                 * Went for this approach hoping to minimize needless searching
                 */
                $user = User::where('email', $email)
                    ->where('password', $password)
                    ->get()->first();



                // Check if the secondary search gives any results
                if($user !== null)
                {
                    $response = array(
                        'status' => $responseCode->success,
                        'email' => $user->email,
                        'username' => $user->name
                    );

                    return json_encode($response);
                }

                // Secondary search returning no results only means that the password was incorrect
                else{
                    $response = array(
                        'status' => $responseCode->error,
                        'error' => "Wrong password"
                    );

                    return json_encode($response);
                }
            }

            // Primary search failure means that the user does not exist in the database
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
