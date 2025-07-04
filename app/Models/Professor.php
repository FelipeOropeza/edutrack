<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turmasDisciplinas()
    {
        return $this->belongsToMany(Turma::class, 'professor_turma_disciplina')
                    ->withPivot('disciplina_id')
                    ->withTimestamps();
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class, 'professor_turma_disciplina')
                    ->withPivot('turma_id')
                    ->withTimestamps();
    }
}
