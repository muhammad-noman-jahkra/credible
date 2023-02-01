<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function attendanceReport(){
        return view('report.attandence');
    }
}
