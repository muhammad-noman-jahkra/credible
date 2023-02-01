<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LivewireToaster extends Component
{
    public function render()
    {
        return view('livewire.livewire-toaster')->extends('layouts.app');
    }

    public function alert($type, $message)
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => $type,  'message' =>  $message]);
    }
}
