<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.professor')]
class CadastroAluno extends Component
{
    public function render()
    {
        return view('livewire.cadastro-aluno');
    }
}
