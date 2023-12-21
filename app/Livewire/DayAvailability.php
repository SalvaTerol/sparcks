<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DayAvailability extends Component
{
    public $day;
    public $array;
    public $available;
    public $status;
    public $showHours = false;
    public $response;


    public function mount($day, $array, $status)
    {
        $this->day = $day;
        $this->array = $array;
        $this->available = $array['available'] ? true : false;
        $this->status = $status;
    }

    public function checkHours()
    {
        $this->dispatch('check', day: $this->day);
    }


    public function render()
    {
        return view('livewire.day-availability');
    }
}
