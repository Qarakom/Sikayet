<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login() {

        if(!empty(Auth::check())){
            if(Auth::user()->user_type==1){
                return redirect()->route('admin.dashboard');
            }
            else  if(Auth::user()->user_type==2){
                return redirect()->route('sikayetci.dashboard');
            }
            else  if(Auth::user()->user_type==3){
                return redirect()->route('operator.dashboard');
            }
        }

        return view('auth.login');
    }

    public function AuthLogin(Request $request) {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){

            if(Auth::user()->user_type==1){
                return redirect('admin/dashboard');
            }
            else  if(Auth::user()->user_type==2){
                return redirect('sikayetci/dashboard');
            }
            else  if(Auth::user()->user_type==3){
                return redirect('operator/dashboard');
            }

            else {
                Auth::logout();
                return redirect()->route('login');
            }



        }
        else {
            return redirect()->back()->with('error', 'Please enter correct email or paswword');
        }
        //dd($request->all());
    }

    public function logout (){
        Auth::logout();
        return redirect(url(''));
    }


}
