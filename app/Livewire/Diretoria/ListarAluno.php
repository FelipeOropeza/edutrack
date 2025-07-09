<?php

namespace App\Livewire\Diretoria;

use App\Models\Aluno;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class ListarAluno extends Component
{
    public $alunos;

    public function mount()
    {
        $this->alunos = Aluno::with('turmas')->orderBy('nome')->get();
    }

    public function render()
    {
        return view('livewire.diretoria.listar-aluno');
    }
}
