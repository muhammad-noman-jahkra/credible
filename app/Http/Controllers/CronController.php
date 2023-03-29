<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class CronController extends Controller
{
    public function checkAttendance(){

        $todaysAttendance = Attendance::where(['day'=>Carbon::now()->format('Y-m-d')])->whereNull('out_time')->get();
        
        $empList = array();

        if(!empty($todaysAttendance)){

            foreach ($todaysAttendance as $a) {
                $empList[] = $a->employee;
                $a->out_time = Carbon::now()->format('Y-m-d 19:00:00');
                $a->punch_out_ip = 'System';
                $a->save();
            }

            $details = [
                'to_email'=> 'umair@fletchersthatchersdosanis.co.uk',
                'mail_data'=>['employee_list'=>$empList,'to_name'=>'Umair','subject'=>'List of employees that don\'t mark off attendance.'],
                'template'=>'system-mark-attendance'
            ];
    
            dispatch(new SendEmailJob($details));
        }
        
        
    }

    public function testing(Request $request){
        dd(file_get_contents('http://www.geoplugin.net/json.gp?ip='.$request->ip()));
    }
}
