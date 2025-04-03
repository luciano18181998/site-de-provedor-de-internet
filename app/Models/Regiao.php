<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    use HasFactory;

    protected $table = 'regioes';

    protected $fillable = ['nome'];

    // Relacionamento: Uma região pode ter vários planos
    public function planos()
    {
        return $this->hasMany(Plano::class, 'regiao_id');
    }
}
