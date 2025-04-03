<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    protected $table = 'faturas'; // Nome da tabela no banco

    protected $fillable = [
        'usuario_id',
        'valor',
        'data_vencimento',
        'status'
    ];

    // Relacionamento com o usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
