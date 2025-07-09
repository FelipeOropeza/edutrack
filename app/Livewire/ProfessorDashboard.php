<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.professor')]
class ProfessorDashboard extends Component
{
    public function render()
    {
        return view('livewire.professor-dashboard');
    }
}
