<?php

namespace App\Livewire\Responsavel;


use App\Models\Responsavel;
use App\Models\Falta;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\DiaLetivo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.responsavel')]
class VisualizarFaltas extends Component
{
    public $alunos;
    public $alunoSelecionado = null;
    public $bimestre = 1;

    public function mount()
    {
        $user = Auth::user();
        $responsavel = Responsavel::where('user_id', $user->id)->first();

        $this->alunos = $responsavel->alunos;

        if ($this->alunos->isNotEmpty()) {
            $this->alunoSelecionado = $this->alunos->first()->id;
        }
    }

    public function getFaltasProperty()
    {
        if (!$this->alunoSelecionado)
            return collect();

        // Calcula datas de início e fim do bimestre (no ano atual)
        $inicio = \Carbon\Carbon::createFromDate(now()->year, ($this->bimestre - 1) * 3 + 1, 1)->startOfMonth();
        $fim = (clone $inicio)->addMonths(2)->endOfMonth();

        return Falta::with(['disciplina', 'diaLetivo'])
            ->whereHas('alunoTurma', fn($q) => $q->where('aluno_id', $this->alunoSelecionado))
            ->whereHas('diaLetivo', fn($q) => $q->whereBetween('data', [$inicio, $fim]))
            ->orderBy('dia_letivo_id')
            ->get()
            ->groupBy(fn($falta) => optional($falta->disciplina)->nome ?? 'Sem disciplina');
    }

    public function render()
    {
        return view('livewire.responsavel.visualizar-faltas', [
            'faltasPorDisciplina' => $this->faltas,
        ]);
    }
}
