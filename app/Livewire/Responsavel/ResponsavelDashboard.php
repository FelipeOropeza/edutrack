<?php

namespace App\Livewire\Responsavel;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.responsavel')]
class ResponsavelDashboard extends Component
{
    public function render()
    {
        return view('livewire.responsavel.responsavel-dashboard');
    }
}
