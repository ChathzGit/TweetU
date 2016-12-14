<?php
namespace App\Http\Controllers;

use Codebird\Codebird;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

require 'C:\xampp\htdocs\TweetU_1.0\vendor\autoload.php';

class SendTweetsController extends Controller
{
    public function sendTweets()
    {
        $tweet = null;

        //handle new searches
        if (isset($_GET['nnn']))
        {
            $tweet = $_GET['nnn'];

            $cb = new Codebird;

            $cb->setConsumerKey(
                'NW4jK56ldmuaRUOXodhx4n3pE',
                'iZ8xkBT26CsDZtNILe8rJBwClZTLhp1tzQNyErjdBLvlF3fgC6'
            );

            $cb->setToken(
                '801639845324013568-Tutg9ujroZJEIhwOptTOCC39eY5YQj4',
                '2y8As12FhvrYg0zejOvISjEZlAUY3527ymCmfhe5KYdFf'
            );

            $cb->statuses_update([
                'status' => $tweet
            ]);

        }
    }

}