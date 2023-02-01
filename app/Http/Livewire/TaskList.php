<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

use App\Models\Task;
use App\Models\User;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;

use function PHPUnit\Framework\isEmpty;

class TaskList extends Component
{
    public $tasks;

    public $empList;
    public $empName;
    public $dateRange;
    public $todayDate;


    public function mount()
    {
        $this->empList = employee::pluck('name','id');
        $this->empName ='';
        $this->todayDate = Carbon::now()->toDateTimeString();
        $this->dateRange = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::yesterday()->toDateTimeString())->format('Y-m-d').' - '.Carbon::createFromFormat('Y-m-d H:i:s', $this->todayDate)->format('Y-m-d');
    }

    public function render()
    {
       
        $tasks = Task::orderBy('id', 'desc');
        
        if(Auth::user()->hasRole(['EMPLOYEE'])){
            $emp = employee::where(['user_id'=>Auth::user()->id])->first();
            $tasks->with('taskMeta')->whereHas('taskMeta', function ($query) use($emp){
                $query->where('claimBy','=',$emp->id);
            });
        }
        if(!empty($this->empName)){
            $emp = $this->empName;
            $tasks->with('taskMeta')->whereHas('taskMeta', function ($query) use($emp){
                $query->where('claimBy','=',$emp);
            });
        }


        $start = explode(' - ',$this->dateRange)[0];
        $end = explode(' - ',$this->dateRange)[1];
        $tasks->whereBetween('created_at',[$start." 23:59:59",$end." 23:59:59"]);
      
        $this->tasks = $tasks->get();
        
        return view('livewire.task-list.task-list');
    }
}
