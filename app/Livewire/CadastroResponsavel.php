<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class CadastroResponsavel extends Component
{
    public $nome, $email;
    public $alunos = []; // array temporário dos alunos
    public $modalAberto = false;

    public $nomeAluno, $dataNascimentoAluno;

    public function adicionarAluno()
    {
        $this->validate([
            'nomeAluno' => 'required|string',
            'dataNascimentoAluno' => 'required|date',
        ]);

        $this->alunos[] = [
            'nome' => $this->nomeAluno,
            'data_nascimento' => $this->dataNascimentoAluno,
        ];

        $this->reset(['nomeAluno', 'dataNascimentoAluno']);
        $this->modalAberto = false;
    }

    public function salvarResponsavel()
    {
        $this->validate([
            'nome' => 'required|string',
            'email' => 'required|email',
        ]);

        // salvar responsável e alunos (exemplo)
        // Responsavel::create([...]);
        // foreach($this->alunos as $aluno) { Aluno::create([...]); }

        session()->flash('successo', 'Responsável e alunos cadastrados com sucesso!');
        $this->reset(['nome', 'email', 'alunos']);
    }

    public function render()
    {
        return view('livewire.cadastro-responsavel');
    }
}
