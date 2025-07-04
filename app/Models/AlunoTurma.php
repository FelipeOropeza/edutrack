<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlunoTurma extends Model
{
    protected $table = 'aluno_turma';

    protected $fillable = ['aluno_id', 'turma_id', 'status'];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
