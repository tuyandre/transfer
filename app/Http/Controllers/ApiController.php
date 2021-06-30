<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
       }elseif ($country=="BURUNDI"){
           $currency="";
       }
       elseif ($country=="BURUNDI"){
           $currency="";
       }
       elseif ($country=="BURUNDI"){
           $currency="";
       }
       elseif ($country=="BURUNDI"){
           $currency="";
       }
       elseif ($country=="BURUNDI"){
           $currency="";
       } else {
           $currency="RWF";
       }




       return $currency;
    }
    public function clientRegister(Request $request){


        $compte=ApiController::generateCompte();
        return User::create([
            'name' => $request['name'],
            'telephone' => $request['telephone'],
            'email' => $request['email'],
            'nid' => $request['nid'],
            'compte' => $compte,
            'country' => $request['country'],
            'password' => Hash::make($request['password']),
        ]);
    }
}
