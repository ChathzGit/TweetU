<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util\TweetUResponseCode;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Unirest\Exception;

class UserAccountController extends Controller
{

    /*
     * Loads the user registration page
     */
    public function index()
    {
        return view('pages.frontEnd.registration');
    }

    /*
     * Loads the users page
     */
    public function loadUserPage()
    {
        return view('pages.backEnd.userAccountsPage');
    }


    /*
     * Saves a user into the database
     */
    public function saveUser(Request $request)
    {

        // Create empty user
        $user = new User;

        /*
         * Get the data from the request and assign the
         * values into local variables
         */
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');


        // Response code that will be sent to the front end
        $responseCode = new TweetUResponseCode();

        try {

            // Save the user to the database, or return error
            if ($user->save()) {
                $response = array(
                    'status' => $responseCode->success
                );
            } else {
                $response = array(
                    'status' => $responseCode->error
                );
            }

            return json_encode($response);

        } catch (QueryException $e) {

            // Check if the QueryException is an integrity violation
           if($e->getCode() === '23000')
           {
               $response = array(
                   'status' => $responseCode->error,
                   'error' => "User with the same email already exists"
               );

               return json_encode($response);
           }

           // Check if the QueryException is any other violation
            else{

                $response = array(
                    'status' => $responseCode->error,
                    'error' => "Error creating account"
                );

                return json_encode($response);
            }
        }

        // Catch all other exceptions
        catch (Exception $e) {

            $response = array(
                'status' => $responseCode->error,
                'error' => "Error creating account"
            );

            return json_encode($response);
        }
    }


    /*
     * Gets all the users from the database
     */
    public function getAllUsers()
    {
        $userList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {

            $userList = User::all();
            $response = array(
                'status' => $responseCode->success,
                'userList' => $userList
            );

            return json_encode($response);

        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error
            );
            return json_encode($response);
        }


    }


}
