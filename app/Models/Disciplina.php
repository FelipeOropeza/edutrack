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

    public function vinculos()
    {
        return $this->hasMany(ProfessorTurmaDisciplina::class);
    }

    public function faltas()
    {
        return $this->hasMany(Falta::class);
    }
}
