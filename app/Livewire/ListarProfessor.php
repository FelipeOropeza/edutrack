<?php

namespace App\Livewire;

use App\Models\Professor;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class ListarProfessor extends Component
{
    public $professor;

    public function mount($id)
    {
        $this->professor = Professor::with('user', 'vinculos.turma', 'vinculos.disciplina')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.listar-professor');
    }
}
