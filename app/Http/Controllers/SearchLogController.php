<?php namespace App\Http\Controllers;

use App\Http\Controllers\Util\TweetUResponseCode;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SearchLog;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Unirest\Exception;

class SearchLogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function loadSearchDataTestDataInterface()
    {
        return view('pages.backEnd.adminAddSearchLogsTest');
    }

    public function getSearchLogs()
    {
        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {
            $searchLogList = SearchLog::where('timestamp', '>=', date('2016-11-12 10:10:00'))
                ->where('timestamp', '<=', '2016-11-25 10:10:00')
                ->get();

            $response = array(
                'status' => $responseCode->success,
                'searchLogList' => $searchLogList
            );

            return json_encode($response);
        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error,
            );

            return json_encode($response);
        }
    }


    public function getAllSearchLogs()
    {

        $searchLogList = [];
        $responseCode = new TweetUResponseCode();
        $response = "";

        try {
            $searchLogList = SearchLog::all();
            $response = array(
                'status' => $responseCode->success,
                'searchLogList' => $searchLogList
            );

            return json_encode($response);
        } catch (Exception $e) {
            $response = array(
                'status' => $responseCode->error,
            );

            return json_encode($response);
        }


    }

    public function saveSearchLog(Request $request)
    {
        $searchLog = new SearchLog;

        //$searchLog->user_id = $request->input('userId');
        $searchLog->key_word = $request->input('key_word');
        $searchLog->user_id = $request->input('user_id');
        $searchLog->type = $request->input('type');
        $searchLog->timestamp = date('Y-m-d H:i:s');

        $responseCode = new TweetUResponseCode();

        try {

            if($searchLog->save())
            {
                $response = array(
                    'status' => $responseCode->success
                );
            }
            else {
                $response = array(
                    'status' => $responseCode->error
                );
            }

            return json_encode($response);
        }

        catch (QueryException $e) {

            // Check if the QueryException is an integrity violation
            if ($e->getCode() === '23000') {
                $response = array(
                    'status' => $responseCode->error,
                    'error' => "Duplicate search log",
                    'errordetails' => $e->getMessage()
                );

                return json_encode($response);
            } // Check if the QueryException is any other violation
            else {

                $response = array(
                    'status' => $responseCode->error,
                    'error' => "Error saving search log",
                    'errordetails' => $e->getMessage()
                );

                return json_encode($response);
            }
        }

        // Catch all other exceptions
        catch (Exception $e) {

            $response = array(
                'status' => $responseCode->error,
                'error' => "Error saving search log",
                'errordetails' => $e->getMessage()
            );

            return json_encode($response);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}

