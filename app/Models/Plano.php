<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    protected $table = 'planos';

    protected $fillable = ['nome', 'valor', 'descricao', 'regiao_id'];

    // Relacionamento: Um plano pertence a uma região
    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regiao_id');
    }
}
