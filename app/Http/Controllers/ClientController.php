<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all(); //Show all the clients in table clients
    }


    //sendClient function return all the clients to the CreateClient view
    public function sendClient()
    {
        //get all clients Ordered by id
        $clients= Client::orderBy('id','DESC')->get();
        // return clients to the view CreateClient
        return view('CreateClient',compact('clients'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //store() function saves the client data that we request to save it in the clients tabl
    public function store(Request $request)
    {

        //validate the feilds that user enter in the form in CreateClient.blade.php view
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:clients',
        ]);
        if ($validator->fails()) {
            //return the error if the validation fails
            return response()->json(['status' => "Error", 'data' => "", "message" => $validator->errors()], 500);
        }
        else  {


            //make a client object and save it into the clients table
            $client = DB::table("clients")->where('email',$request->email)->first();
            if (!$client){
                $client = new Client();

                $client->name = $request->name;
                $client->mobile = $request->mobile;
                $client->email = $request->email;
                $client->save();
            }


            //return the response with a success message
            return response()->json(['status' => "done", 'data' => "", "message" => 'Added successfully'], 200);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //show function return you to CreateClient view
    public function show(Request $request)
    {
        return view('CreateClient');
    }


}
