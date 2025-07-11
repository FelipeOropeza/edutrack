<?php

namespace App\Livewire\Professor;

use Livewire\Component;
use App\Models\DiaLetivo;
use App\Models\Disciplina;
use App\Models\Turma;
use App\Models\AlunoTurma;
use App\Models\Falta;
use Livewire\Attributes\Layout;

#[Layout('layouts.professor')]
class RegistrarFaltas extends Component
{
    public $dia_letivo_id;
    public $turma_id;
    public $disciplina_id;

    public $alunos = [];
    public $presencas = [];

    public function updated($property)
    {
        if (in_array($property, ['dia_letivo_id', 'turma_id', 'disciplina_id'])) {
            $this->carregarAlunos();
        }
    }

    public function carregarAlunos()
    {
        $this->reset(['alunos', 'presencas']);

        if (!$this->dia_letivo_id || !$this->turma_id || !$this->disciplina_id) {
            $this->alunos = [];
            return;
        }

        $this->alunos = AlunoTurma::with('aluno')
            ->where('turma_id', $this->turma_id)
            ->get();

        foreach ($this->alunos as $alunoTurma) {
            $falta = Falta::firstOrCreate([
                'aluno_turma_id' => $alunoTurma->id,
                'disciplina_id' => $this->disciplina_id,
                'dia_letivo_id' => $this->dia_letivo_id,
            ], ['presente' => true]);

            $this->presencas[$alunoTurma->id] = (bool) $falta->presente;
        }
    }

    public function salvar()
    {
        foreach ($this->presencas as $alunoTurmaId => $presente) {
            Falta::where([
                'aluno_turma_id' => $alunoTurmaId,
                'disciplina_id' => $this->disciplina_id,
                'dia_letivo_id' => $this->dia_letivo_id,
            ])->update(['presente' => $presente]);
        }

        session()->flash('sucesso', 'Frequência salva com sucesso.');
    }

    public function render()
    {
        return view('livewire.professor.registrar-faltas', [
            'diasLetivos' => DiaLetivo::orderBy('data')->get(),
            'turmas' => Turma::all(),
            'disciplinas' => Disciplina::all(),
        ]);
    }
}
