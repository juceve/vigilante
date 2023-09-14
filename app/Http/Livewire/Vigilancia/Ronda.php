<?php

namespace App\Http\Livewire\Vigilancia;

use Livewire\Component;

class Ronda extends Component
{
    public function render()
    {
        return view('livewire.vigilancia.ronda')->extends('layouts.app');
    }
}
