<?php

namespace App\Livewire\Responsavel;

use App\Models\Responsavel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.responsavel')]
class VerNotasFilhos extends Component
{
    public $bimestre = 1;
    public $filhos;

    public function mount()
    {
        $responsavel = Responsavel::where('user_id', Auth::id())->first();

        if ($responsavel) {
            $this->filhos = $responsavel->alunos()->with(['avaliacoes.disciplina'])->get();
        }
    }

    public function render()
    {
        return view('livewire.responsavel.ver-notas-filhos', [
            'filhosComNotas' => $this->filhos
        ]);
    }
}
