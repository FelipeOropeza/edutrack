<?php

namespace App\Livewire\Diretoria;

use Livewire\Component;
use App\Models\AlunoTurma;
use App\Models\Avaliacao;
use App\Models\ProfessorTurmaDisciplina;
use App\Models\Aluno;
use App\Models\Turma;
use Livewire\Attributes\Layout;

#[Layout('layouts.diretoria')]
class AssociarAluno extends Component
{
    public $aluno_id;
    public $turma_id;

    public function render()
    {
        return view('livewire.diretoria.associar-aluno', [
            'alunos' => Aluno::all(),
            'turmas' => Turma::all(),
        ]);
    }

    public function associar()
    {
        $this->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'turma_id' => 'required|exists:turmas,id',
        ]);

        $alunoTurma = AlunoTurma::create([
            'aluno_id' => $this->aluno_id,
            'turma_id' => $this->turma_id,
            'status' => 'ativo',
        ]);

        $disciplinas = ProfessorTurmaDisciplina::where('turma_id', $this->turma_id)
            ->pluck('disciplina_id');

        foreach ($disciplinas as $disciplina_id) {
            for ($bimestre = 1; $bimestre <= 4; $bimestre++) {
                for ($numero = 1; $numero <= 3; $numero++) {
                    Avaliacao::create([
                        'aluno_turma_id' => $alunoTurma->id,
                        'disciplina_id' => $disciplina_id,
                        'bimestre' => $bimestre,
                        'numero' => $numero,
                        'nota' => 0.0,
                    ]);
                }
            }
        }

        session()->flash('message', 'Aluno associado e avaliações criadas com sucesso!');
        $this->reset(['aluno_id', 'turma_id']);
    }
}
