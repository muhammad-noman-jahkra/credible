<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Attendance;
use App\Models\User;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use function PHPUnit\Framework\isEmpty;
use Carbon\Carbon;
use App\Helpers\AppHelper;


class AttendanceReport extends Component
{
    public $att;
    public $empList;
    public $empName;
    public $month;
    public $monthList;
    public $year;
    public $yearList;
    public $daysInMonth;
    public $totalAttendDays;
    public $totalWorkingHours;
    public $updateMode = false;
    public $totalWorkingDaysInMonth;
    public $totalWorkingHoursInMonth;
    
    public function mount()
    {
        $this->empList = employee::pluck('name','id');
        
        $this->totalWorkingDaysInMonth = 0 ;
        $this->totalWorkingHoursInMonth = $this->totalWorkingDaysInMonth* config('constants.options.office_working_hours') ;

        $mo = [];
        for ($m=1; $m<=12; $m++) {
            $mo[$m] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
        $this->att = [];
        $this->monthList =$mo;
        $this->yearList = [2023=>2023];
        $this->daysInMonth = 0;
        $this->totalAttendDays = 0;
        $this->totalWorkingHours = 0;
    }

    public function render()
    {
        return view('livewire.report.attendance-report');
    }

    public function alert($type, $message)
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => $type,  'message' =>  $message]);
    }

    public function getAttendanceReport(){
        
        $this->updateMode = false;
        $this->totalAttendDays = 0;
        $this->totalWorkingHours = 0;
        
        $att = Attendance::orderBy('id', 'desc');
        
        if(empty($this->empName)){
            
            $this->alert('error','Employee is required. :)');     
            return false;       
        }
        if(empty($this->month)){
            
            $this->alert('error','Month is required. :)');            
            return false;       
        }
        if(empty($this->year)){
            
            $this->alert('error','Year is required. :)');            
            return false;       
        }
       
        $this->daysInMonth = Carbon::now()->month($this->month)->daysInMonth;
        if(Auth::user()->hasRole(['EMPLOYEE'])){
            $emp = employee::where(['user_id'=>Auth::user()->id])->first();
            $att->where(['user_id'=>$emp->id]);
        }

        $att->where(['user_id'=>$this->empName]);

        $att->whereYear('day', '=', $this->year)
            ->whereMonth('day', '=', $this->month);

        $result = $att->get();     
        foreach ($result as $r) {
            if(!empty($r->in_time) && !empty($r->out_time)){
                $this->totalAttendDays ++;
                $this->totalWorkingHours = $this->totalWorkingHours + $r->calAttendanceWorkingHour();
            }
        }

        $this->totalWorkingDaysInMonth = AppHelper::instance()->countDays($this->year,$this->month,[]);

        $this->totalWorkingHoursInMonth = $this->totalWorkingDaysInMonth * config('constants.options.office_working_hours') ;


        $this->updateMode = true;
        $this->att = $result;
    }
}
