<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['nome', 'ano_letivo'];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_turma')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }

    public function professores()
    {
        return $this->belongsToMany(Professor::class, 'professor_turma_disciplina')
                    ->withPivot('disciplina_id')
                    ->withTimestamps();
    }
}
