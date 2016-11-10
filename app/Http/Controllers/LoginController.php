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

    public function checkSession()
    {
        session_start();

        $responseCode = new TweetUResponseCode;

        try {
            if (session_status() == PHP_SESSION_ACTIVE) {
                $response = array(
                    'status' => $responseCode->success,
                    'username' => $_SESSION['username'],
                    'sessionStatusCode' => session_status(),
                    'sessionStatus' => 'active'
                );

                return json_encode($response);
            } else if (session_status() == PHP_SESSION_NONE) {
                $response = array(
                    'status' => $responseCode->success,
                    'sessionStatusCode' => session_status(),
                    'sessionStatus' => 'none'
                );

                return json_encode($response);
            } else {
                $response = array(
                    'status' => $responseCode->success,
                    'sessionStatusCode' => session_status(),
                    'sessionStatus' => 'none'
                );

                return json_encode($response);
            }
        }

        catch (Exception $e)
        {
            $response = array(
                'status' => $responseCode->error,
                'errorMessage' => $e->getMessage()
            );

            return json_encode($response);
        }


    }

    public function logout()
    {

        session_start();
        $responseCode = new TweetUResponseCode;

        try {
            session_destroy();

            $response = array(
                'status' => $responseCode->success,
            );

            return json_encode($response);
        }
        catch(Exception $e)
        {
            $response = array(
                'status' => $responseCode->error,
                'errorMessage' => $e->getMessage()
            );

            return json_encode($response);
        }
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

                    session_start();
                    $_SESSION['userID'] = $user->id;
                    $_SESSION['username'] = $user->name;
                    $_SESSION['email'] = $user->email;

                    $response = array(
                        'status' => $responseCode->success,
                        'sessionStatus' => $_SESSION['username'],
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
