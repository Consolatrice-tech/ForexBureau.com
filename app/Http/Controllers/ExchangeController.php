<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Exception;
// use Redirect;
// use Session;
// use URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ExchangeController extends Controller
{
    private $_api_context;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getExpensePage()
    {
        $AuthenticatedUser = Auth::user();
        return view('Exchange')->with('AuthenticatedUser', $AuthenticatedUser);
    }
    public function exchange(Request $request)
    {
        $exchangeType = $request->input('exchangeType');
        if (!$exchangeType) {
            return back()->with('danger', 'please select the type of exchange that you want');
        } else {
            if ($exchangeType == "RwfToUSD") {
                $rwfAmount = $request->input('AmountInRwf');
                if (empty($rwfAmount)) {
                    return back()->with('danger', 'please re-select the currency and input the amount');
                }
                if ($rwfAmount < 850) {
                    return back()->with('danger', 'the minimum amount in rwf to exchange is 850 rwf');
                }
                $exchangeTransaction  = Http::post('https://api.ishema.rw/api/v1/payment', [
                    "phone_number" => Auth::user()->phone_no,
                    "amount" => $rwfAmount,
                    "client_name" => "Lambert",
                    "token" => "KNxnrqgFxmYzC64XkEjdnX6yV5Gox4",
                    "credit_number" => "250781605853",
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
            } else {

                $totalAmount = $request->input('AmountInUSD');
                if (empty($totalAmount)) {
                    return back()->with('danger', 'please enter your USD Amount an try again');
                } else {
                    $apiContext = new \PayPal\Rest\ApiContext(
                        new \PayPal\Auth\OAuthTokenCredential(
                            'AR04eieDPHws88Lenh_LDFZzZxGssVau6A7DG2WHQcS0kV8E8Ua41uCPNoNHXjjCTg696Oc2tXc1KGP0',
                            'EEGiWRZCTe6ahCpLzFtJDf0AJQxfbgilgxcXu8UxmLTkUInvCsxUahZ2tX7610YntxUOOWoeBr5R4V4y'
                        )
                    );
                    $payer = new Payer();
                    $payer->setPaymentMethod("paypal");
                    //Itemized information (Optional) Lets you specify item wise information

                    $item1 = new Item();
                    $item1->setName('Exchange from USD to RWF')
                        ->setCurrency('USD')
                        ->setPrice($totalAmount);

                    $itemList = new ItemList();
                    $itemList->setItems(array($item1));


                    $amount = new Amount();
                    $amount->setCurrency("USD")
                        ->setTotal($totalAmount);

                    $transaction = new Transaction();
                    $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription("Payment description")
                        ->setInvoiceNumber(uniqid());


                    $redirectUrls = new RedirectUrls();
                    $redirectUrls->setReturnUrl("http://localhost:8000")
                        ->setCancelUrl("http://localhost:8000");

                    $payment = new Payment();


                    $payment->setIntent("order")
                        ->setPayer($payer)
                        ->setRedirectUrls($redirectUrls)
                        ->setTransactions(array($transaction));
                    //For Sample Purposes Only.

                    $request = clone $payment;

                    try {
                        $paymentdetail = $payment->create($apiContext);
                        $now = new DateTime;
                        $today = $now->format('Y-m-d');

                        $newPaymentRecord = Exchange::create([
                            'user_id' => Auth::user()->id,
                            'exchange_type' => 'USD_TO_RWF',
                            'amount_exchanged' => $totalAmount,
                            'amount_received' => $totalAmount * 990.49,
                            'date' => $today
                        ]);
                    } catch (Exception $ex) {
                        //NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

                        return back()->withInput()->with('danger', 'please try again..there is a slow internet connection');
                    }
                    foreach ($payment->getLinks() as $link) {
                        if ($link->getRel() == 'approval_url') {
                            $redirect_url = $link->getHref();
                            break;
                        }
                    }

                    /* here you could already add a database entry that a person started buying stuff (not finished of course) */
                    Session::put('paypal_payment_id', $payment->getId());

                    if (isset($redirect_url)) {
                        // redirect to paypal
                        return redirect()->away($redirect_url);
                    }
                }
            }
        }
    }
}
