<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nome', 'telefone', 'cpf', 'email', 'data_vencimento', 'regiao_id', 'plano_id'];

    // Relacionamento: Um usuário pertence a uma região
    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regiao_id');
    }

    // Relacionamento: Um usuário pertence a um plano
    public function plano()
    {
        return $this->belongsTo(Plano::class, 'plano_id');
    }
}
