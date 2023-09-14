<?php

namespace App\Http\Livewire\Vigilancia;

use Livewire\Component;

class HombreVivo extends Component
{
    public function render()
    {
        return view('livewire.vigilancia.hombre-vivo')->extends('layouts.app');
    }
}
