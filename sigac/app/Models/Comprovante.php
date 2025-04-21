<?php
// app/Models/Comprovante.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comprovante extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'horas',
        'atividade',
        'categoria_id',
        'aluno_id',
        'user_id'
    ];

    // Relacionamento: Um comprovante pertence a uma categoria
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relacionamento: Um comprovante pertence a um aluno
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    // Relacionamento: Um comprovante pertence a um usuário (quem registrou)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento: Um comprovante pode ter uma declaração
    public function declaracao(): HasOne
    {
        return $this->hasOne(Declaracao::class);
    }
}