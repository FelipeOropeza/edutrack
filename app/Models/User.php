<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    // Relacionamento com Professor
    public function professor()
    {
        return $this->hasOne(Professor::class);
    }

    // Relacionamento com Responsavel
    public function responsavel()
    {
        return $this->hasOne(Responsavel::class);
    }
}
