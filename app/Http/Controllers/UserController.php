<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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
}
