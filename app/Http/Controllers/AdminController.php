<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Exchange;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('Administrator');
    }
    public function index()
    {
        $authenticatedAdministrator = Auth::user();
        $allTransactionsNumber = Transaction::count();
        $allTransactions = Transaction::get();
        $allExchangesNumber = Exchange::count();
        return view('Administrator.Transactions')->with('allTransactions', $allTransactions)->with('allTransactionsNumber', $allTransactionsNumber)->with('allExchangesNumber', $allExchangesNumber)->with('admin', $authenticatedAdministrator);
    }
}
