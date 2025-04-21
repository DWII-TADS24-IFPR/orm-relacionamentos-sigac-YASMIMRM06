<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // ANOTAÇÃO: Campos preenchíveis
    protected $fillable = ['name', 'description'];

    // ANOTAÇÃO: Relação com papéis
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // ANOTAÇÃO: Relação com usuários
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}