<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'data_nascimento', 'responsavel_id'];

    public function responsavel()
    {
        return $this->belongsTo(Responsavel::class);
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'aluno_turma')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function avaliacoes()
    {
        return $this->hasManyThrough(
            Avaliacao::class,
            AlunoTurma::class,
            'aluno_id',
            'aluno_turma_id',
            'id',
            'id'
        );
    }
}
