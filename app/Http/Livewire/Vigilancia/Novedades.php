<?php

namespace App\Http\Livewire\Vigilancia;

use Livewire\Component;

class Novedades extends Component
{
    public function render()
    {
        return view('livewire.vigilancia.novedades')->extends('layouts.app');
    }
}
