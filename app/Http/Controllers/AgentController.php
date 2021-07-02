<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $trans=Transaction::with(['Transfer','Receiver'])
            ->where('transfer_id','=',Auth::user()->id)
            ->where('category','=',"Saving")
            ->orderBy('id', 'DESC')->get();
        return response()->json(['transactions' => $trans], 200);
    }



    public function clientWithdraw(){
        return view('backend.agents.client_withdraw');
    }
    public function getClientWithdraw(){
        $trans=Transaction::with(['Transfer','Receiver'])
            ->where('receiver_id','=',Auth::user()->id)
            ->where('category','=',"Withdraw")
            ->orderBy('id', 'DESC')->get();
        return response()->json(['transactions' => $trans], 200);
    }
    public function clientTransaction(){
        return view('backend.agents.client_transaction');
    }
    public function getClientTransaction(){
        $trans=Transaction::with(['Transfer','Receiver'])

            ->where('compte','!=',Auth::user()->compte)
            ->where(function ($query) {
                $query->where('transfer_id','=',Auth::user()->id)
                    ->orWhere('receiver_id','=',Auth::user()->id);
            })
            ->orderBy('id', 'DESC')->get();
        return response()->json(['transactions' => $trans], 200);
    }

    public function agentTransaction(){
        return view('backend.agents.my_transaction');
    }
    public function getMyTransaction(){
        $trans=Transaction::with(['Transfer','Receiver'])
            ->where('compte','=',Auth::user()->compte)
            ->orderBy('id', 'DESC')->get();
        return response()->json(['transactions' => $trans], 200);
    }

    public function saveClientSaving(Request $request){
        $client=User::where('compte','=',$request['compte'])->first();
        $bal=Transaction::where('compte','=',Auth::user()->compte)
            ->orderBy('id', 'DESC')->first();
        if ($client){
            if ($bal){
                if ($bal->balances>$request['amount']){
                    $currency1 = Auth::user()->currency;
                    $currency2 = $client->currency;

                    $sent_amount=$request['amount'];
                    $exchanged_amount=Currency::convert()
                        ->from($currency1)
                        ->to($currency2)
                        ->amount($sent_amount)
                        ->get();
                    $lastRecord=Transaction::where('compte','=',$client->compte)
                        ->orderBy('id', 'DESC')->first();
                    if ($lastRecord){
                        $deposit = new Transaction();
                        $deposit->transfer_id=Auth::user()->id;
                        $deposit->previous_balances=$lastRecord->balances;
                        $deposit->balances=($exchanged_amount+$lastRecord->balances);
                        $deposit->amounts=$exchanged_amount;
                        $deposit->receiver_id=$client->id;
                        $deposit->compte=$client->compte;
                        $deposit->category="Saving";
                        $deposit->save();
                    }else {
                        $deposit = new Transaction();
                        $deposit->transfer_id=Auth::user()->id;
                        $deposit->balances=$exchanged_amount;
                        $deposit->amounts=$exchanged_amount;
                        $deposit->receiver_id=$client->id;
                        $deposit->compte=$client->compte;
                        $deposit->category="Saving";
                        $deposit->save();
                    }
                    $credit=new Transaction();
                    $credit->transfer_id=Auth::user()->id;
                    $credit->compte=Auth::user()->compte;
                    $credit->receiver_id=$client->id;
                    $credit->category="Credit";
                    $credit->amounts=-($sent_amount);
                    $credit->previous_balances=$bal->balances;
                    $credit->balances=($bal->balances-$request['amount']);
                    $credit->save();
                    return response()->json(['status' => "ok","transaction"=>$credit], 200);

                }else{
                    return response()->json(['status' => "below",'message'=>"You are out of Cash. Your Balance:".$bal->balances], 200);
                }

            }else{
                return response()->json(['status' => "low",'message'=>"You are New Agent Please Deposit Cash on your Compte"], 200);
            }

        }else{
            return response()->json(['status' => "invalid",'message'=>"This Compte is Invalid"], 200);
        }
    }

}
