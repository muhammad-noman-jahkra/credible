<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Termwind\render;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\employee;

class DashboardController extends Controller
{
    
    public function dashboard(){
        if (Auth::user()->hasRole(['SUPER_ADMIN','ADMIN'])){

            return view('dashboard.adminDashboard');
        }else{

            $emp = employee::where(['user_id'=>Auth::user()->id])->first();

            $att = Attendance::where(['user_id'=>$emp->id])->orderBy('id', 'desc')->take(3)->get();

            $lastAtt = Attendance::where(['user_id'=>$emp->id])->orderBy('id', 'desc')->first();

            return view('dashboard.empDashboard', compact(['emp','att','lastAtt']));
        }
    }
}
