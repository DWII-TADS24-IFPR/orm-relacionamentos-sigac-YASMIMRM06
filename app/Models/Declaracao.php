<?php
// app/Models/Declaracao.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Declaracao extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'hash',
        'data',
        'aluno_id',
        'comprovante_id'
    ];

    // Define que o campo 'data' deve ser tratado como datetime
    protected $casts = [
        'data' => 'datetime'
    ];

    // Relacionamento: Uma declaração pertence a um aluno
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    // Relacionamento: Uma declaração pertence a um comprovante
    public function comprovante(): BelongsTo
    {
        return $this->belongsTo(Comprovante::class);
    }
}