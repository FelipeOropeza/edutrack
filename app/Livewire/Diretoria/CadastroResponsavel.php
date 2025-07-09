<?php

namespace App\Livewire\Diretoria;

use App\Models\Aluno;
use App\Models\Responsavel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class CadastroResponsavel extends Component
{
    public $nome, $email;
    public $alunos = [];
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

        $user_id = User::create([
            'name' => $this->nome,
            'email' => $this->email,
            'password' => Hash::make($this->email),
            'role' => 'responsavel',
        ])->id;
        
        $id_responsavel = Responsavel::create([
            'user_id' => $user_id,
        ])->id;

        foreach ($this->alunos as $aluno) {
            Aluno::create([
                'nome' => $aluno['nome'],
                'data_nascimento' => $aluno['data_nascimento'],
                'responsavel_id' => $id_responsavel,
            ]);
        }

        session()->flash('successo', 'Responsável e alunos cadastrados com sucesso!');
        $this->reset(['nome', 'email', 'alunos']);
    }

    public function render()
    {
        return view('livewire.diretoria.cadastro-responsavel');
    }
}
