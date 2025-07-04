<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class DiretoriaDashboard extends Component
{
    public function render()
    {
        return view('livewire.diretoria-dashboard');
    }
}
