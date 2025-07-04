<?php

namespace App\Livewire;

use App\Models\Turma;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class CadastroTurma extends Component
{
    public $nome;
    public $ano_letivo;
    public $search = '';

    public function cadastrar()
    {
        $this->validate([
            'nome' => 'required|string|max:255',
            'ano_letivo' => 'required|digits:4|integer|min:2000|max:2100',
        ]);

        Turma::create([
            'nome' => $this->nome,
            'ano_letivo' => $this->ano_letivo,
        ]);

        $this->reset(['nome', 'ano_letivo']);
        session()->flash('message', 'Turma cadastrada com sucesso!');
    }

    public function render()
    {
        $turmas = Turma::query()
            ->where('nome', 'like', '%' . $this->search . '%')
            ->orWhere('ano_letivo', 'like', '%' . $this->search . '%')
            ->orderBy('ano_letivo', 'desc')
            ->get();

        return view('livewire.cadastro-turma', compact('turmas'));
    }
}
