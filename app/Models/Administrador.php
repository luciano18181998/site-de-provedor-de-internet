<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use HasFactory, Notifiable; // Adicione a trait Notifiable

    protected $table = 'administradores'; // Nome correto da tabela

    protected $fillable = [
        'nome',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
