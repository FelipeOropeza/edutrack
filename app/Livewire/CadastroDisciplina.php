<?php

namespace App\Livewire;

use App\Models\Disciplina;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class CadastroDisciplina extends Component
{
    public $nome;
    public $search = '';

    public function cadastrar()
    {
        $this->validate([
            'nome' => 'required|string|max:255|unique:disciplinas,nome',
        ]);

        Disciplina::create([
            'nome' => $this->nome,
        ]);

        $this->reset('nome');
        session()->flash('message', 'Disciplina cadastrada com sucesso!');
    }

    public function render()
    {
        $disciplinas = Disciplina::query()
            ->where('nome', 'like', '%' . $this->search . '%')
            ->orderBy('nome')
            ->get();

        return view('livewire.cadastro-disciplina', compact('disciplinas'));
    }
}
