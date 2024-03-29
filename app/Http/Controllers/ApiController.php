<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\CompanyCompte;
use App\Models\Role;
use App\Models\Temporary;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\TransferSms;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
   public function clientLogin(Request $request){
       if(is_numeric($request->get('email'))){
           $chekauth=Auth::attempt(['telephone' => $request->email, 'password' => $request->password]);
           if($chekauth){

               return response()->json(['login' => $chekauth,'user'=>Auth::user()], 200);

           }else{
               return response()->json(['login' => $chekauth,'user'=>$chekauth], 401);
           }
       }else{
           $checkauth2=Auth::attempt(['email' => $request->email, 'password' => $request->password]);
           if($checkauth2){

               return response()->json(['login' => $checkauth2,'user'=>Auth::user()], 200);


           }else{
               return response()->json(['login' => $checkauth2,'user'=>$checkauth2], 401);
           }

       }


   }
    public function generateCompte(){

        $number = mt_rand(100000000, 999999999);
        if (ApiController::checkCompte($number)) {
            return ApiController::generateCompte();
        }
        return $number;

    }
    public function checkCompte($number){
        return User::whereCompte($number)->exists();
    }
    public function getCurrency($country){
       $currency="";
       if ($country=="RWANDA"){
           $currency="RWF";
       }elseif ($country=="KENYA"){
           $currency="KES";
       }
       elseif ($country=="TANZANIE"){
           $currency="TZS";
       }
       elseif ($country=="BURUNDI"){
           $currency="BIF";
       }
       elseif ($country=="UGANDA"){
           $currency="UGX";
       }
       elseif ($country=="SUDAN"){
           $currency="SDG";
       } else {
           $currency="RWF";
       }

       return $currency;
    }
    public function clientRegister(Request $request){


        $compte=ApiController::generateCompte();
        $currency=ApiController::getCurrency($request['country']);

        $role = Role::where('name', '=', "client")->first();
//        return $role;
        if ($role===null) {
            $role = Role::create(
                ['name' =>  "client",
                    'display_name' =>  "Client",
                    'description' => "Client Send,Save and Transfer Money",]);
        }

            $user = User::create([
                'name' => $request['name'],
                'telephone' => $request['telephone'],
                'email' => $request['email'],
                'nid' => $request['nid'],
                'compte' => $compte,
                'role_id' => $role->id,
                'currency' => $currency,
                'country' => $request['country'],
                'password' => Hash::make($request['password']),
            ]);
            $user->attachRole($role);
            return $user;
        }
        public function getClientTransaction(Request $request){
       $transaction=Transaction::with(['Transfer','Receiver'])
           ->where('transfer_id','=',$request['client'])
           ->orWhere('receiver_id','=',$request['client'])
           ->get();
            return response()->json(['transactions' => $transaction], 200);
        }

        public function checkotp(Request $request){
           // $profi=DB::Table('users')->select('profile')->where('id',$request['client'])->get();
    
           $profi =User::where('id', $request['client'])->value('profile');
           if($profi ==$request['code']){
            return response()->json(['result:' =>'ok'], 201);

        }else{
            return response()->json(['result:' =>'Invalid authentication code'], 401);
        }
            
        }

        public function  clientcheckuser(Request $request){ 

            
        $otpnber = mt_rand(100000, 999999);
        
    
            DB::table('users')->where('id',$request['client'])->limit(1)->update(['profile' => $otpnber]);
        
            $userphone=DB::table('users')->where('id',$request['client'])->first()->telephone;
            $username=DB::table('users')->where('id',$request['client'])->first()->name;
            
            $sms=new TransferSms();
            $sms->sendSMS($userphone,'Hello '.$username.' Your Authentication code for QMT system is '.$otpnber);
         
            return response()->json(['message:' =>'authentication code is sent successfully'], 201);


        }

        public function getClientBalance(Request $request){

       $bal=Transaction::where('compte','=',$request['client'])
           ->orderBy('id', 'DESC')->first();
           return response()->json(['balance' => $bal], 200);
        }

        public function clientTransferMoney(Request $request){
            $sender=User::find($request['transfer']);
            $bal=Transaction::where('compte','=',$sender->compte)
                ->orderBy('id', 'DESC')->first();
       $receiver=User::where('compte','=',$request['receiver'])->first();
            $moon=($request['amount']*2)/100;
            $charges=(int)$moon;
       if ($bal){
           if ($bal->balances>($request['amount']+$charges)) {
               if ($receiver) {
                   $transfer = User::find($request['transfer']);
                   $currency1 = $transfer->currency;
                   $currency2 = $receiver->currency;

                   $sent_amount=$request['amount'];
                   $exchanged_amount=Currency::convert()
                       ->from($currency1)
                       ->to($currency2)
                       ->amount($sent_amount)
                       ->get();
                       $lastRecord=Transaction::where('compte','=',$receiver->compte)
                           ->orderBy('id', 'DESC')->first();
                       if ($lastRecord){
                           $deposit = new Transaction();
                           $deposit->transfer_id=$transfer->id;
                           $deposit->previous_balances=$lastRecord->balances;
                           $deposit->balances=($exchanged_amount+$lastRecord->balances);
                           $deposit->amounts=$exchanged_amount;
                           $deposit->receiver_id=$receiver->id;
                           $deposit->category="Received";
                           $deposit->compte=$receiver->compte;
                           $deposit->save();
                       }else {
                           $deposit = new Transaction();
                           $deposit->transfer_id=$transfer->id;
                           $deposit->balances=$exchanged_amount;
                           $deposit->amounts=$exchanged_amount;
                           $deposit->receiver_id=$receiver->id;
                           $deposit->category="Received";
                           $deposit->compte=$receiver->compte;
                           $deposit->save();
                       }
                       $credit=new Transaction();
                       $credit->transfer_id=$transfer->id;
                       $credit->receiver_id=$receiver->id;
                       $credit->category="Transfer";
                       $credit->amounts=$request['amount'];
                       $credit->previous_balances=$bal->balances;
                       $credit->balances=($bal->balances-($request['amount']+$charges));
                       $credit->fees=$charges;
                       $credit->compte=$transfer->compte;
                       $credit->save();
                   $company=CompanyCompte::orderBy('id', 'DESC')->first();
                   if ($company){
                       $rates = new CompanyCompte();
                       $rates->transfer_id=$transfer->id;
                       $rates->balances=($company->balances+$charges);
                       $rates->amounts=$charges;
                       $rates->receiver_id=$receiver->id;
                       $rates->previous_balances=$company->balances;
                       $rates->save();
                   }else{
                       $rates = new CompanyCompte();
                       $rates->transfer_id=$transfer->id;
                       $rates->balances=($charges);
                       $rates->amounts=$charges;
                       $rates->receiver_id=$receiver->id;
                       $rates->save();
                   }
                   $sender_message=$transfer->name." "."Woherereje "." ".$receiver->name." "."Amafaranga"." ".$sent_amount.$currency1." "."Waciwe"." ".$charges;
                   $receiver_message=$receiver->name." "."Wakiriye Amafaranga"." ".$exchanged_amount.$currency2." "."Avuye kuri"." ".$transfer->name;
                   $sms=new TransferSms();
                   $sms->sendSMS($transfer->telephone,$sender_message);
                   $sms->sendSMS($receiver->telephone,$receiver_message);
                       return response()->json(['message' => "Transfer","transaction"=>$credit], 200);


               } else {
                   return response()->json(['message' => "invalid receiver"], 200);
               }
           }else{
               return response()->json(['message' => "minimum balance"], 200);
           }
       }else{
           return response()->json(['message' => "no saving"], 200);
       }

        }
        public function clientWithdraw(Request $request){
            $sender=User::find($request['transfer']);
            $bal=Transaction::where('compte','=',$sender->compte)
                ->orderBy('id', 'DESC')->first();
            $receiver=User::where('compte','=',$request['receiver'])->first();
            $moon=($request['amount']*3)/100;
            $charges=(int)$moon;
            if ($bal){
                if ($bal->balances>($request['amount']+$charges)) {
                    if ($receiver) {
                        $transfer = User::find($request['transfer']);
                        $currency1 = $transfer->currency;
                        $currency2 = $receiver->currency;

                        $sent_amount=$request['amount'];
                        $exchanged_amount=Currency::convert()
                            ->from($currency1)
                            ->to($currency2)
                            ->amount($sent_amount)
                            ->get();
                            $deposit = new Temporary();
                            $deposit->transfer_id=$transfer->id;
                            $deposit->balances=$exchanged_amount;
                            $deposit->amounts=$exchanged_amount;
                            $deposit->receiver_id=$receiver->id;
                            $deposit->category="Withdraw";
                            $deposit->compte=$sender->compte;
                            $deposit->fees=$charges;
                            $deposit->save();

                        return response()->json(['message' => "wait","transaction"=>$deposit], 200);


                    } else {
                        return response()->json(['message' => "invalid receiver"], 200);
                    }
                }else{
                    return response()->json(['message' => "minimum balance"], 200);
                }
            }else{
                return response()->json(['message' => "no saving"], 200);
            }
        }
}
