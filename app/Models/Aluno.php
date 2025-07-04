<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'data_nascimento', 'responsavel_id'];

    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'aluno_turma')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
