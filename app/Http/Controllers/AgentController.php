<?php

namespace App\Http\Controllers;

use App\Models\CompanyCompte;
use App\Models\Temporary;
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
    public function clientPendingWithdraw(){
        return view('backend.agents.pending_withdraw');
    }
    public function getClientPendingWithdraw(){
        $trans=Temporary::with(['Transfer','Receiver'])
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

    public function approvePendingWithdraw($id){
        $temp=Temporary::find($id);
        if ($temp){
            $client=User::find($temp->transfer_id);
            $agent_bal=Transaction::where('compte','=',Auth::user()->compte)->first();
            $client_bal=Transaction::where('compte','=',$client->compte)->first();
            $charges=$temp->fees;

            $withdraw = new Transaction();
            $withdraw->transfer_id=$client->id;
            $withdraw->balances=($client_bal->balances-$charges-$temp->amounts);
            $withdraw->amounts=$temp->amounts;
            $withdraw->receiver_id=Auth::user()->id;
            $withdraw->compte=$client->compte;
            $withdraw->previous_balances=$client_bal->balances;
            $withdraw->category="Withdraw";
            $withdraw->save();
            if ($agent_bal) {
                $agent = new Transaction();
                $agent->transfer_id = $client->id;
                $agent->balances = ($agent_bal->balances + $temp->amounts);
                $agent->amounts = $temp->amounts;
                $agent->receiver_id = Auth::user()->id;
                $agent->compte = Auth::user()->compte;
                $agent->previous_balances = $agent_bal->balances;
                $agent->category = "Agent_Withdraw";
                $agent->fees=$charges;
                $agent->save();
            }else{
                $agent = new Transaction();
                $agent->transfer_id = $client->id;
                $agent->balances = ($temp->amounts);
                $agent->amounts = $temp->amounts;
                $agent->receiver_id = Auth::user()->id;
                $agent->compte = Auth::user()->compte;
               $agent->fees=$charges;
                $agent->category = "Agent_Withdraw";
                $agent->save();
            }
            $company=CompanyCompte::orderBy('id', 'DESC')->first();
            if ($company){
                $rates = new CompanyCompte();
                $rates->transfer_id=$client->id;
                $rates->balances=($company->balances+$charges);
                $rates->amounts=$charges;
                $rates->receiver_id=Auth::user()->id;
                $rates->previous_balances=$company->balances;
                $rates->save();
            }else{
                $rates = new CompanyCompte();
                $rates->transfer_id=$client->id;
                $rates->balances=($charges);
                $rates->amounts=$charges;
                $rates->receiver_id=Auth::user()->id;
                $rates->save();
            }
            $temp->delete();
            return response()->json(['status' => "ok"], 200);
        }
    }
}
