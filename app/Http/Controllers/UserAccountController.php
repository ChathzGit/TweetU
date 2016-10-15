<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util\TweetUResponseCode;

use App\User;
use Illuminate\Http\Request;
use Unirest\Exception;

class UserAccountController extends Controller
{

    //
    public function index()
    {
        return view('pages.frontEnd.registration');
    }

    public function loadUserPage()
    {
        return view('pages.backEnd.userAccountsPage');
    }

    public function saveUser(Request $request)
    {
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');


        $responseCode = new TweetUResponseCode();

        try {
            if($user->save())
            {
                $response = array(
                    'status' => $responseCode->success
                );
            }

            else
            {
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


    public function test(Request $request)
    {
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');


        $responseCode = new TweetUResponseCode();

        try {
            $user->save();

            $response = array(
                'status' => $responseCode->success,
            );

            return json_encode($response);

        } catch (Exception $e) {

            $response = array(
                'status' => $responseCode->error,
                'error' => $e
            );

            return json_encode($response);

        }
    }


}
