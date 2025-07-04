<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

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
}
