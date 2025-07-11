<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaLetivo extends Model
{
    protected $table = 'dias_letivos';

    protected $fillable = ['data', 'bimestre', 'descricao'];

    public function faltas()
    {
        return $this->hasMany(Falta::class);
    }
}
