<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function clientSaving(){
       return view('backend.agents.client_saving');
   }
    public function getClientSaving(){
        $trans=Transaction::all();
        return response()->json(['transactions' => $trans], 200);
    }



    public function clientWithdraw(){
        return view('backend.agents.client_withdraw');
    }
    public function getClientWithdraw(){
        $trans=Transaction::all();
        return response()->json(['transactions' => $trans], 200);
    }
    public function clientTransaction(){
        return view('backend.agents.client_transaction');
    }
    public function getClientTransaction(){
        $trans=Transaction::all();
        return response()->json(['transactions' => $trans], 200);
    }

    public function agentTransaction(){
        return view('backend.agents.my_transaction');
    }
    public function getMyTransaction(){
        $trans=Transaction::all();
        return response()->json(['transactions' => $trans], 200);
    }
}
