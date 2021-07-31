<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PayPal\Api\Payout;
use Paypal\Api\PayoutSenderBatchHeader;
use DateTime;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexOfPaypal()
    {
        $auth = Auth::user();
        return view('Paypal')->with('Auth', $auth);
    }
    public function indexOfOltranz()
    {
        $auth = Auth::user();
        return view('Oltranz')->with('Auth', $auth);
    }
    public function MyTransactions()
    {
        $auth = Auth::user()->phone_no;
        $myTransactions = Transaction::where('sender_Phone', $auth)->get();
        return view('MyTransactions')->with('myTransactions', $myTransactions);
    }
    public function oltranzTransaction(Request $request)
    {
        $receiverNumber = $request->input('receiverNumber');
        $receiverNames = $request->input('receiverNames');
        $receiverLocation = $request->input('receiverLocation');
        $amount = $request->input('amount');
        $description = $request->input('description');
        $now = new Datetime();
        $date2 = $now->format('Y-m-d');
        if (empty($receiverNumber) || empty($receiverNames) || empty($receiverLocation) || empty($amount) || empty($description)) {
            return back()->withInput()->with('danger', 'please fill all fields');
        } else {
            $exchangeTransaction  = Http::post('https://api.ishema.rw/api/v1/payment', [
                "phone_number" => Auth::user()->phone_no,
                "amount" => $amount,
                "client_name" => "Lambert",
                "token" => "KNxnrqgFxmYzC64XkEjdnX6yV5Gox4",
                "credit_number" => $receiverNumber,
                "external_id" => rand(1, 1000000000000000),
                "callback_url" => "https://www.google.com"
            ]);
            $response = json_decode($exchangeTransaction, true);
            if (!$response) {
                //return response()->json(['message' => 'an error occured or you may have insufficient balance..please check your balance and try again'], 400);
                return back()->with('danger', 'an error occured or you may have insufficient balance..please check your balance and try again');
            }
            if ($response['status'] == 3) {
                return back()->with('danger', 'payment could not be made..please try again');
            }
            $fullNames = Auth::user()->fname . '  ' . Auth::user()->lname;
            $oltranzTransaction = Transaction::create([
                'sender_Names' => $fullNames,
                'receiver_Names' => $receiverNames,
                'receiver_Location' => $receiverLocation,
                'sender_Phone' => Auth::user()->phone_no,
                'amount' => $amount,
                'Transaction_type' => 'OLTRANZ',
                'date' => $date2,
                'currency' => 'RWF',
            ]);
            if ($oltranzTransaction) {
                return back()->with('success', 'Transaction Made successfully..you can continue the transfer process to your mobile phone..thank you for using our services');
            }
            return back()->with('danger', 'an error occured..please try again');
        }
    }
    public function tryPayout()
    {
        return 123;
    }
}
