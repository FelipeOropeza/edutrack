<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Falta extends Model
{
    protected $fillable = [
        'aluno_turma_id',
        'disciplina_id',
        'dia_letivo_id',
        'presente',
    ];

    public function alunoTurma()
    {
        return $this->belongsTo(AlunoTurma::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function diaLetivo()
    {
        return $this->belongsTo(DiaLetivo::class);
    }
}
