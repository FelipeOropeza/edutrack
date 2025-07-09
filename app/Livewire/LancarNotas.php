<?php

namespace App\Livewire;

use App\Models\AlunoTurma;
use App\Models\Avaliacao;
use App\Models\Professor;
use App\Models\ProfessorTurmaDisciplina;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.professor')]
class LancarNotas extends Component
{
    public $turma_id;
    public $disciplina_id;
    public $bimestre = 1;
    public $notas = [];

    public function getTurmasProperty()
    {
        $usuarioId = Auth::id();
        $professor = Professor::where('user_id', $usuarioId)->first();

        if (!$professor) return collect();

        return ProfessorTurmaDisciplina::where('professor_id', $professor->id)
            ->with('turma')
            ->get()
            ->pluck('turma')
            ->unique('id');
    }

    public function getDisciplinasProperty()
    {
        $usuarioId = Auth::id();
        $professor = Professor::where('user_id', $usuarioId)->first();

        if (!$professor || !$this->turma_id) return collect();

        return ProfessorTurmaDisciplina::where('professor_id', $professor->id)
            ->where('turma_id', $this->turma_id)
            ->with('disciplina')
            ->get()
            ->pluck('disciplina')
            ->unique('id');
    }

    public function getAlunosProperty()
    {
        if (!$this->turma_id) return collect();

        return AlunoTurma::where('turma_id', $this->turma_id)
            ->with('aluno')
            ->get()
            ->pluck('aluno');
    }

    public function updatedDisciplinaId()
    {
        $this->carregarNotas();
    }

    public function updatedBimestre()
    {
        $this->carregarNotas();
    }

    public function updatedTurmaId()
    {
        $this->disciplina_id = null;
        $this->notas = [];
    }

    public function salvarNotas()
    {
        foreach ($this->notas as $aluno_id => $avaliacoes) {
            $alunoTurma = AlunoTurma::where('aluno_id', $aluno_id)
                ->where('turma_id', $this->turma_id)
                ->first();

            foreach ($avaliacoes as $numero => $nota) {
                Avaliacao::updateOrCreate(
                    [
                        'aluno_turma_id' => $alunoTurma->id,
                        'disciplina_id' => $this->disciplina_id,
                        'bimestre' => $this->bimestre,
                        'numero' => $numero,
                    ],
                    [
                        'nota' => $nota,
                    ]
                );
            }
        }

        session()->flash('message', 'Notas salvas com sucesso!');
    }

    private function carregarNotas()
    {
        if (!$this->turma_id || !$this->disciplina_id || !$this->bimestre) return;

        $alunoTurmas = AlunoTurma::where('turma_id', $this->turma_id)->get();

        foreach ($alunoTurmas as $alunoTurma) {
            $avaliacoes = Avaliacao::where('aluno_turma_id', $alunoTurma->id)
                ->where('disciplina_id', $this->disciplina_id)
                ->where('bimestre', $this->bimestre)
                ->get();

            foreach ($avaliacoes as $avaliacao) {
                $this->notas[$alunoTurma->aluno_id][$avaliacao->numero] = $avaliacao->nota;
            }
        }
    }

    public function render()
    {
        return view('livewire.lancar-notas', [
            'turmas' => $this->turmas,
            'disciplinas' => $this->disciplinas,
            'alunos' => $this->alunos,
        ]);
    }
}
