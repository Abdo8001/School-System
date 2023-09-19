<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $test;
    public function print(){
        return $this->test++;
    }
    public function render()
    {
        return view('livewire.counter');
    }
}
