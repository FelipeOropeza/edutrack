<?php

namespace App\Livewire;

use App\Models\Aluno;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class ListarAluno extends Component
{
    public $alunos;

    public function mount()
    {
        $this->alunos = Aluno::orderBy('nome')->get();
    }

    public function render()
    {
        return view('livewire.listar-aluno');
    }
}
