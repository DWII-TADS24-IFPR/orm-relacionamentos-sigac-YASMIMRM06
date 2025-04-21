<?php
// app/Models/Curso.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'sigla',
        'total_horas',
        'nivel_id',
        'eixo_id'
    ];

    // Relacionamento: Um curso pertence a um nível
    public function nivel(): BelongsTo
    {
        return $this->belongsTo(Nivel::class);
    }

    // Relacionamento: Um curso pertence a um eixo
    public function eixo(): BelongsTo
    {
        return $this->belongsTo(Eixo::class);
    }

    // Relacionamento: Um curso pode ter muitas turmas
    public function turmas(): HasMany
    {
        return $this->hasMany(Turma::class);
    }

    // Relacionamento: Um curso pode ter muitos alunos
    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }

    // Relacionamento: Um curso pode ter muitas categorias
    public function categorias(): HasMany
    {
        return $this->hasMany(Categoria::class);
    }
}