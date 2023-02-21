<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Jobs\SendEmailJob;

class CheckAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attendance Checking';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todaysAttendance = Attendance::where(['day'=>Carbon::now()->format('Y-m-d')])->whereNull('out_time')->get();
        
        $empList = array();

        if(!empty($todaysAttendance)){
            foreach ($todaysAttendance as $a) {
                $empList[] = $a->employee;
                $a->out_time = Carbon::now()->format('Y-m-d 19:00:00');
                $a->punch_out_ip = 'System';
                $a->save();
            }
        }
        
        $details = [
            'to_email'=> 'umair@fletchersthatchersdosanis.co.uk',
            'mail_data'=>['employee_list'=>$empList,'to_name'=>'Umair','subject'=>'List of employees that don\'t mark off attendance.'],
            'template'=>'system-mark-attendance'
        ];

        dispatch(new SendEmailJob($details));


        return Command::SUCCESS;
    }
}
