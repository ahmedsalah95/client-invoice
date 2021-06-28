<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Client;
use App\Models\Invoice;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;
use Validator;

class InvoiceController extends Controller
{
    public function __construct(Client $client, Invoice $invoice)
    {
        $this->client = $client;
        $this->invoice = $invoice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice::all(); //Show all the Invoices in table invoices


    }


    //sendInvoice function return all the invoices to the SendInvoice view

    public function sendInvoice()
    {
                $invoices= Invoice::orderBy('id','DESC')->get();
                return view('SendInvoice',compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //store() function saves the invoice  data that we request to save it in the invoices table
    //if the client doesn't exist in the clients table it will add his data also

    public function store(Request $request)
    {
        //validate the fields that user enter in the form in SendInvoice.blade.php view


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'amount' => 'required',
            'due_date' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            //return the error if the validation fails

            return response()->json(['status' => "Error", 'data' => "", "message" => $validator->errors()], 500);
        }
        else  {



            $client = DB::table("clients")->where('email',$request->email)->first();
        if (!$client){

            //if the client data doesn't exist make a client object and save it into the clients table

            $client = new Client();

            $client->name = $request->name;
            $client->mobile = $request->mobile;
            $client->email = $request->email;
            $client->save();
        }
            //make a invoice  object and save it into the invoices table

        $invoice = new Invoice();
        $invoice->client_id = $client->id;
        $invoice->amount = $request->amount;
        $invoice->due_date = $request->due_date;
        $invoice->save();

        //send mail to the client mail with sendEmail function that takes
        // three parameters the mail,amount and due_date that the user enter to the form

       $this->sendEmail($request->email,$request->amount,$request->due_date,$request->name);

            //return the response with a success message

        return response()->json(['status' => "done", 'data' => "", "message" => 'Added successfully'], 200);

        }
    }


    /**
     * @return string
     */
    //sendEmail function used to send mail to the client email
    public function sendEmail($email,$amount,$due_date,$name)
    {
        $details=[
            'title' =>$amount,
            'body'=>$due_date,
            'name'=>$name,
        ];

        Mail::to($email)->send( new TestMail($details));

        return true;
    }
    //show function return you to SendInvoice view

    public function show(Request $request){

        return view('SendInvoice');
    }

}
