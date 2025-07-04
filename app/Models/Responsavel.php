<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Responsável pode ter vários alunos (filhos)
    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}
