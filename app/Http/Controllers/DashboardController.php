<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::user()->user_type==1){
            $data['header_title']='Admin Dashboard';
            return view('admin.dashboard',$data);
        }
        else  if(Auth::user()->user_type==2){
            $data['header_title']='Şikayətçi Dashboard';
            return view('sikayetci.dashboard',$data);
        }
        else  if(Auth::user()->user_type==3){
            $data['header_title']='Operator Dashboard';
            return view('operator.dashboard',$data);
        }
    }
}
