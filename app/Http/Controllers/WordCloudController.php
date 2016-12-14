<?php
namespace App\Http\Controllers;

use DB;
use App\search;


class WordCloudController extends Controller
{
    public function getKeywords()
    {

        session_start();

        if (isset($_SESSION['role'])) {

            if ($_SESSION['role'] == 'admin') {

                //handle new searches
                if (isset($_GET['term']))
                {
                    // get the current time
                    $now = date("Y-m-d H:i:s");

                    // get the submitted term
                    $term = $_GET['term'];

                    $checkQuery = search::where(
                        'term','=',$term
                    )->count();

                    // check if the term has been submitted before
                    if($checkQuery > 0)
                    {
                        //if the term exists - update the counter and the last search timestamp
                        DB::update('update searches set counter = counter+1, datetime = ? where term = ?', [$now, $term]);
                    }

                    else
                    {
                        //if the term does not exist - insert a new record
                        DB::insert('insert into searches (term, counter, datetime) values (?, ?, ?)', [$term, 1, $now]);
                    }
                }


                // prepare the tag cloud array for display
                $terms = array(); // create empty array
                $maximum = 0; // $maximum is the highest counter for a search term

                $results = DB::select('SELECT term, counter FROM searches ORDER BY counter DESC LIMIT 30');

                foreach($results as $row)
                {
                    $term = $row->term;
                    $counter = $row->counter;

                    // update $maximum if this term is more popular than the previous terms
                    if ($counter > $maximum) $maximum = $counter;

                    $terms[] = array('term' => $term, 'counter' => $counter);

                }

                // shuffle terms unless you want to retain the order of highest to lowest
                shuffle($terms);



                return view('pages/backEnd/adminSiteStatistics',['terms'=>$terms, 'maximum'=>$maximum]);

            } else {
                return view('pages.frontEnd.homepage');
            }

        } else {
            return view('pages.frontEnd.homepage');
        }




    }

}

?>