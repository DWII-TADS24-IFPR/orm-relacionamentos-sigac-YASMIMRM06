<?php
// app/Models/Nivel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nivel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome'
    ];

    // Relacionamento: Um nível pode ter muitos cursos
    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class);
    }
}