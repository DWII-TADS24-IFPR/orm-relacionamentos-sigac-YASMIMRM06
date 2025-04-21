<?php
// app/Models/Aluno.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    use SoftDeletes; // Habilita o soft delete (exclusão lógica)

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'nome', 
        'cpf', 
        'email', 
        'senha', 
        'user_id', 
        'curso_id', 
        'turma_id'
    ];

    // Esconde o campo senha nas respostas JSON
    protected $hidden = [
        'senha'
    ];

    // Relacionamento: Um aluno pertence a um curso
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    // Relacionamento: Um aluno pertence a uma turma
    public function turma(): BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }

    // Relacionamento: Um aluno pertence a um usuário (User)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento: Um aluno pode ter muitos comprovantes
    public function comprovantes(): HasMany
    {
        return $this->hasMany(Comprovante::class);
    }

    // Relacionamento: Um aluno pode ter muitas declarações
    public function declaracoes(): HasMany
    {
        return $this->hasMany(Declaracao::class);
    }
}