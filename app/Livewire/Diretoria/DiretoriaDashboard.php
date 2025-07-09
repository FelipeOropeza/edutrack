<?php

namespace App\Livewire\Diretoria;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class DiretoriaDashboard extends Component
{
    public function render()
    {
        return view('livewire.diretoria.diretoria-dashboard');
    }
}
