<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    // ANOTAÇÃO: Adicionando novos relacionamentos
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    // ANOTAÇÃO: Relação com atividades complementares
    public function atividadesComplementares()
    {
        return $this->hasMany(AtividadeComplementar::class);
    }

    // ANOTAÇÃO: Acesso ao usuário associado
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}