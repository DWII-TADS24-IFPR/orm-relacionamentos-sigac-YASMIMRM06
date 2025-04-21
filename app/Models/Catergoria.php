<?php
// app/Models/Categoria.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'maximo_horas',
        'curso_id'
    ];

    // Relacionamento: Uma categoria pertence a um curso
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    // Relacionamento: Uma categoria pode ter muitos documentos
    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }

    // Relacionamento: Uma categoria pode ter muitos comprovantes
    public function comprovantes(): HasMany
    {
        return $this->hasMany(Comprovante::class);
    }
}