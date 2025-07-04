<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = ['nome'];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function professores()
    {
        return $this->belongsToMany(Professor::class, 'professor_turma_disciplina')
                    ->withPivot('turma_id')
                    ->withTimestamps();
    }
}
