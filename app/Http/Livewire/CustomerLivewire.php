<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;

class CustomerLivewire extends Component
{

    public $customers, $name, $phone_no, $email, $address , $company_name, $customer_id;
    public $updateMode = false;
    

    public function render()
    {

        $this->customers = Customer::all();
        return view('livewire.customer.customer-list');
    }

    private function resetInputFields(){
        $this->name = '';
        $this->phone_no = '';
        $this->email = '';
        $this->address = '';
        $this->company_name = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:11',
            'email' => 'required|email',
            'address' => 'string',
        ]);
  
        Customer::create($validatedDate);
  
        session()->flash('message', 'Customer Created Successfully.');
  
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $Customer = Customer::findOrFail($id);

        $this->customer_id = $id;
        $this->name = $Customer->name;
        $this->phone_no = $Customer->phone_no;
        $this->email = $Customer->email;
        $this->address = $Customer->address;
        $this->company_name = $Customer->company_name;
  
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:11',
            'email' => 'required|email',
            'address' => 'string',
        ]);
  
        $Customer = Customer::find($this->customer_id);
        if(!empty($Customer)){

            $Customer->update([
                'name' => $this->name ,
                'phone_no' => $this->phone_no ,
                'email' => $this->email ,
                'address' => $this->address ,
                'company_name' => $this->company_name ,
            ]);

            $this->updateMode = false;
            $this->alert('success','Customer Updated Successfully. :)');            
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
