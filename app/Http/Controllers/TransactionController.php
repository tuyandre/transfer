<?php

namespace App\Http\Controllers;

use App\Models\CompanyCompte;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $trans=Transaction::with(['Transfer','Receiver'])->orderBy('id', 'DESC')->get();
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
    public function agentDeposit(Request $request){
        $agent=User::where('compte','=',$request['compte'])->first();

        if ($agent){
        if ($agent->hasRole('agent')){
            $bal=Transaction::where('transfer_id','=',$agent->id)
                ->orWhere('receiver_id','=',$agent->id)
                ->orderBy('id', 'DESC')->first();
            if ($bal){
                $deposit = new Transaction();
                $deposit->transfer_id=Auth::user()->id;
                $deposit->previous_balances=$bal->balances;
                $deposit->balances=($request['amount']+$bal->balances);
                $deposit->amounts=$request['amount'];
                $deposit->receiver_id=$agent->id;
                $deposit->compte=$agent->compte;
                $deposit->category="Deposit";
                $deposit->save();
            }else{
                $deposit = new Transaction();
                $deposit->transfer_id=Auth::user()->id;
                $deposit->balances=$request['amount'];
                $deposit->amounts=$request['amount'];
                $deposit->receiver_id=$agent->id;
                $deposit->compte=$agent->compte;
                $deposit->category="Deposit";
                $deposit->save();
            }
            return response()->json(['status' => "ok",'message'=>"Cash Deposit SuccessFull"], 200);

        }else{
            return response()->json(['status' => "agent",'message'=>"This Compte is not for Agent"], 200);
        }

        }else{
            return response()->json(['status' => "invalid",'message'=>"This Compte is not Available Try Again"], 200);
        }
    }
}
