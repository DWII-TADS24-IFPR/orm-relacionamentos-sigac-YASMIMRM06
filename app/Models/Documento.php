<?php
// app/Models/Documento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documento extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'url',
        'descricao',
        'horas_in',
        'status',
        'comentario',
        'horas_out',
        'categoria_id',
        'user_id'
    ];

    // Relacionamento: Um documento pertence a uma categoria
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relacionamento: Um documento pertence a um usuário (quem registrou)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}