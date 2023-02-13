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

class AttendanceList extends Component
{
    public $att;
    public $empName;
    public $dateRange;
    public $todayDate;

    public $attendance_id;
    public $punch_in_hour;
    public $punch_in_min;
    public $punch_out_hour;
    public $punch_out_min;
    public $updateMode = false;
    
    // public $dateRange =  Carbon::now()->format('Y-m-d').'-'.Carbon::now()->format('Y-m-d');
    
    public $empList;


    public function mount()
    {
        $this->empList = employee::pluck('name','id');
        $this->empName ='';
        $this->todayDate = Carbon::now()->toDateTimeString();
        $this->dateRange = Carbon::createFromFormat('Y-m-d H:i:s', $this->todayDate)->format('Y-m-d').' - '.Carbon::createFromFormat('Y-m-d H:i:s', $this->todayDate)->format('Y-m-d');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        $this->attendance_id = '';
        $this->punch_in_hour = '';
        $this->punch_in_min = '';
        $this->punch_out_hour = '';
        $this->punch_out_min = '';
  
    }

    public function render()
    {
        
        $att = Attendance::orderBy('id', 'desc');
        
        // if($_attendanceRange){
        //     $att->whereBetween('created_at', [Range of Value]);
        // }
       
        if(Auth::user()->hasRole(['EMPLOYEE'])){
            $emp = employee::where(['user_id'=>Auth::user()->id])->first();
            $att->where(['user_id'=>$emp->id]);
        }
        
        if(!empty($this->empName)){
            
            $att->where(['user_id'=>$this->empName]);
        }
        $start = explode(' - ',$this->dateRange)[0];
        $end = explode(' - ',$this->dateRange)[1];
        $att->whereBetween('day',[$start,$end]);
        // dump([$start,$end]);
        $this->att = $att->get();     
        return view('livewire.attendance-list.attendance-list');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);

        $this->attendance_id = $id;
        $this->punch_in_hour = ltrim(Carbon::createFromFormat('Y-m-d H:i:s', $attendance->in_time)->format('H'), "0");
        $this->punch_in_min = ltrim(Carbon::createFromFormat('Y-m-d H:i:s', $attendance->in_time)->format('i'),"0");
        $this->punch_out_hour = ltrim(Carbon::createFromFormat('Y-m-d H:i:s', empty($attendance->out_time) ? $attendance->in_time : $attendance->out_time )->format('H'),"0");
        $this->punch_out_min =  ltrim(Carbon::createFromFormat('Y-m-d H:i:s', empty($attendance->out_time) ? $attendance->in_time : $attendance->out_time )->format('i'),"0");
  
        $this->updateMode = true;
    }

    public function update()
    { 
        $validatedDate = $this->validate([
            'punch_in_hour' => 'required|integer|max:23|min:0',
            'punch_in_min' => 'required|integer|max:59|min:0',
            'punch_out_hour' => 'required|integer|max:23|min:0',
            'punch_out_min' => 'required|integer|max:59|min:0',
        ]);
        $attendance = Attendance::find($this->attendance_id);
        if(!empty($attendance)){

            $attendance->update([
                'in_time' => Carbon::createFromFormat('Y-m-d H:i:s', $attendance->in_time)->format('Y-m-d '.$this->punch_in_hour.':'.$this->punch_in_min.':s') ,
                'out_time' => Carbon::createFromFormat('Y-m-d H:i:s', $attendance->in_time)->format('Y-m-d '.$this->punch_out_hour.':'.$this->punch_out_min.':s') ,
            ]);

            $this->updateMode = false;
            $this->alert('success','Updated Successfully. :)');            
            $this->resetInputFields();
        }else{            
            // $this->lt->alert('error','Something went wrong :(');            
        }
  
        
    }

    public function alert($type, $message)
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => $type,  'message' =>  $message]);
    }
}
