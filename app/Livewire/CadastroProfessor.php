<?php

namespace App\Livewire;

use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\ProfessorTurmaDisciplina;
use App\Models\Turma;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.diretoria')]
class CadastroProfessor extends Component
{
    public string $nome = '';
    public string $email = '';
    public string $password = '';

    public $modalAberto = false;
    public $professorSelecionado = '';
    public $turma_id = null;
    public $disciplina_id = null;

    public $turmas;
    public $disciplinas = [];

    public string $search = '';

    public function mount()
    {
        $this->turmas = Turma::orderBy('ano_letivo', 'desc')->get();
        $this->disciplinas = Disciplina::orderBy('nome')->get();
    }

    public function abrirModalVincular($professorId)
    {
        $this->professorSelecionado = $professorId;
        $this->turma_id = null;
        $this->disciplina_id = null;
        $this->modalAberto = true;
    }

    public function vincularTurmaDisciplina()
    {
        $this->validate([
            'turma_id' => 'required|exists:turmas,id',
            'disciplina_id' => 'required|exists:disciplinas,id',
        ]);

        // Evita duplicidade no vínculo
        $exists = ProfessorTurmaDisciplina::where([
            'professor_id' => $this->professorSelecionado,
            'turma_id' => $this->turma_id,
            'disciplina_id' => $this->disciplina_id,
        ])->exists();

        if (!$exists) {
            ProfessorTurmaDisciplina::create([
                'professor_id' => $this->professorSelecionado,
                'turma_id' => $this->turma_id,
                'disciplina_id' => $this->disciplina_id,
            ]);

            session()->flash('message', 'Professor vinculado à turma e disciplina com sucesso!');
        } else {
            session()->flash('error', 'Esse vínculo já existe.');
        }

        $this->modalAberto = false;
    }

    public function cadastrar()
    {
        $this->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $this->nome,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'professor',
        ]);

        Professor::create([
            'user_id' => $user->id,
        ]);

        session()->flash('message', 'Professor cadastrado com sucesso.');
        $this->reset(['nome', 'email', 'password']);
    }

    public function render()
    {
        $professores = Professor::with('user')
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.cadastro-professor', compact('professores'));
    }
}
