<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Holidays;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use function PHPUnit\Framework\isEmpty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class Holiday extends Component
{
    public $holiday;
    public $search_year;
    public $search_month;
    
    public $holiday_id;
    public $date;
    public $month;
    public $year;
    public $description;
    public $insert_mode = false;

    public function render()
    {
        
        $this->holiday = Holidays::where(['year'=>Carbon::now()->format('Y')])->get();        
        return view('livewire.holiday.holiday');
    }

    
    public function store()
    {
        $validatedDate = $this->validate([
            'date' => 'required|date|date_format:Y-m-d|unique:holidays',
            'description' => 'string|max:100',
            
        ]);

        $h = new Holidays();
        $h->date = $validatedDate['date'];
        $h->description = $validatedDate['description'];
        $h->year = Carbon::now()->format('Y');
        $h->month = Carbon::now()->format('m');

        if($h->save()){
            $this->resetInputFields();
            $this->insert_mode = false;
            $this->alert('success','Date is mark as holiday');
        }else{
            $this->alert('error','Something went wrong');
        }
    }

    public function alert($type, $message)
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => $type,  'message' =>  $message]);
    }

    public function cancel()
    {
        $this->insert_mode = false;
        $this->resetInputFields();
    }

    public function create()
    {
        $this->insert_mode = true;
    }

    private function resetInputFields(){
        $this->description = '';
        $this->date = '';        
    }
}
