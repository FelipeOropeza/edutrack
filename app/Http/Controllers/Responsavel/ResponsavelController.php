<?php

namespace App\Http\Controllers\Responsavel;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Barryvdh\DomPDF\Facade\Pdf;

class ResponsavelController extends Controller
{
    public function gerarPdfNotas($id)
    {
        $aluno = Aluno::with(['alunoTurmas.avaliacoes.disciplina'])->findOrFail($id);

        $avaliacoes = $aluno->alunoTurmas->flatMap->avaliacoes;

        $disciplinas = [];

        $avaliacoesPorDisciplina = $avaliacoes->groupBy(fn($a) => $a->disciplina->nome);

        foreach ($avaliacoesPorDisciplina as $nomeDisciplina => $avaliacoesDisciplina) {
            $mediasPorBimestre = [];

            for ($bimestre = 1; $bimestre <= 4; $bimestre++) {
                $notas = $avaliacoesDisciplina->where('bimestre', $bimestre)->pluck('nota');
                $media = $notas->avg();
                $mediasPorBimestre[$bimestre] = round($media, 2);
            }

            $mediaFinal = collect($mediasPorBimestre)->filter()->avg();

            $disciplinas[$nomeDisciplina] = [
                'bimestres' => $mediasPorBimestre,
                'mediaFinal' => round($mediaFinal, 2)
            ];
        }

        $pdf = Pdf::loadView('livewire.responsavel.notas_pdf', compact('aluno', 'disciplinas'));

        return $pdf->download("notas_aluno_{$aluno->id}.pdf");
    }
}
