<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAdminRegister(){
        $user=User::all();
        $count=$user->count();

        if ($count>0) {
            return view('auth.login');
        }else {

            return view('auth.admin_register');
        }
    }
    public function store(Request $request){


        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $role = new Role();
        $role->name = "admin";
        $role->display_name = "Administrator";    // optional
        $role->description  = "Survey all activities of company";  // optional
        $role->save();

        $user=new User();
        $user->name=$request['name'];
        $user->role_id=$role->id;
        $user->email=$request['email'];
        $user->password=bcrypt($request['password']);
        $user->save();

        $user->attachRole($role);


//        return response()->json(['auth' => "ok"], 200);

        return view('auth.login');
        // return view('home')->with('success','WELCOME TO YOUR DASHBOARD!');

    }
    public function userPages(){
        if (Auth::check()){
            return view('backend.users.userList');
        }else{
            return view('auth.login');
        }
    }
    public function allAgentPage(){
        if (Auth::check()){
            return view('backend.users.allAgent');
        }else{
            return view('auth.login');
        }
    }
    public function allCustomerPages(){
        if (Auth::check()){
            return view('backend.users.allCustomer');
        }else{
            return view('auth.login');
        }
    }
    public function getAllUsers(){
        $cat=User::with(['Role'])
            ->whereHas(
                'roles', function($q){
                $q->where('name', 'agent');
                $q->orWhere('name', 'client');
            }
            )->get();
        return response()->json(['users' => $cat], 200);
    }
    public function getAllAgent(){
        $cat=User::with(['Role'])
            ->whereHas(
                'roles', function($q){
                $q->where('name', 'agent');
            }
            )->get();
        return response()->json(['users' => $cat], 200);
    }
    public function getAllCustomer(){
        $cat=User::with(['Role'])
            ->whereHas(
                'roles', function($q){
                $q->where('name', 'client');
            }
            )->get();
        return response()->json(['users' => $cat], 200);
    }


    public function generateCompte(){

        $number = mt_rand(100000000, 999999999);
        if (UserController::checkCompte($number)) {
            return UserController::generateCompte();
        }
        return $number;

    }
    public function checkCompte($number){
        return User::whereCompte($number)->exists();
    }

    public function storeUser(Request $request){

        $compte=UserController::generateCompte();


        $role = Role::firstOrCreate(
            ['name' =>  "agent"],
            ['display_name' =>  "Agent"],
            ['description' => "Sender or Debit Customer Cash"]
        );


//            $toten = Str::random(4);
        $user = new User();
        $user->name = $request['full_name'];
        $user->nid = $request['nid'];
        $user->role_id = $role->id;
        $user->compte = $compte;
        $user->email = $request['email'];
        $user->country = $request['country'];
        $user->telephone = $request['phone'];
        $user->password = bcrypt($request['password']);
        $user->save();

        $user->attachRole($role);

//        return view('survey-panel-member.account-login');
        return response()->json(['user' => $user, 'message' => 'ok'], 200);

    }
    public function customerDetail($id){
        $user=User::find($id);
        if ($user){
            return view('backend.users.customerDetail',['user'=>$user]);
        }
        else{
            return view('backend.users.userList');
        }
    }
    public function getCustomerDetail($id){
        $trans=Transaction::with(['Transfer','Receiver'])
            ->where('transfer_id','=',$id)
            ->orWhere('receiver_id','=',$id)
            ->orderBy('id', 'DESC')->get();
        return response()->json(['transactions' => $trans], 200);
    }
}
