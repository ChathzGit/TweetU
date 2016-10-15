<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util\TweetUResponseCode;

use App\User;
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
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');


        $responseCode = new TweetUResponseCode();

        try {
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

        } catch (Exception $e) {

            $response = array(
                'status' => $responseCode->error,
                'error' => $e
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
