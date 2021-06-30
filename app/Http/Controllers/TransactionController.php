<?php

namespace App\Http\Controllers;

use App\Models\CompanyCompte;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('backend.admins.transactions');
    }
    public function getClientTransaction(){
        $trans=Transaction::all();
        return response()->json(['transactions' => $trans], 200);
    }
    public function company_compte()
    {
        return view('backend.admins.company_compte');

    }
    public function getCompanyTransaction(){
        $trans=CompanyCompte::all();
        return response()->json(['transactions' => $trans], 200);

    }
}
