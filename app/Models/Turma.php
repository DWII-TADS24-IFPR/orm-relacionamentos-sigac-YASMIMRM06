<?php
// app/Models/Turma.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Turma extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'curso_id',
        'ano'
    ];

    // Relacionamento: Uma turma pertence a um curso
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    // Relacionamento: Uma turma pode ter muitos alunos
    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }
}