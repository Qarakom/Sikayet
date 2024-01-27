<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Mail;
use Str;
use App\Models\User;
use App\Mail\ForgotPasswordMail;

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

    public function ForgotPassword () {
        return view('auth.forgot');
    }

    public function PostForgotPassword (Request $request) {

        $user = User::getEmailSingle($request->email);
       if(!empty($user)){
        $user->remember_token=Str::random(30);
        $user->save();
        Mail::to($user->email)->send(new ForgotPasswordMail($user));
        return redirect(url('forgot-password'))->with('success', "Zəhmət olmasa e-poçtunuza baxın.");
       }

       else {
        return redirect(url('forgot-password'))->with('error', "E-poçt tapılmadı");
       }

    }

    public function reset ($remember_token){
        $user = User::getTokenSingle($remember_token);
        if(!empty($user)){
            $data['user'] = $user;
            return view('auth.reset');
        }
        else
        {
            abort(404);
        }
    }


    public function PostReset ($remember_token, Request $request){

        if(($request->password == $request->tpassword) && !empty($request->password)) {

            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token=Str::random(30);
            $user->save();

            return redirect(url(''))->with('success', 'Şifrəniz dəyişdirildi');

        }
        else {
            return redirect()->back()->with('error', 'Yeni şifrənizi biri digəri ilə uyğun gəlmir.');
        }
    }

    public function logout (){
        Auth::logout();
        return redirect(url(''));
    }


}
