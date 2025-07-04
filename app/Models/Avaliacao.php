<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = ['aluno_id', 'disciplina_id', 'bimestre', 'numero', 'nota', 'observacao'];

    public function alunoTurma()
    {
        return $this->belongsTo(AlunoTurma::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}
