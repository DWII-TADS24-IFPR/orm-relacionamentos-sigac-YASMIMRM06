<?php
namespace App\Models;

use App\Traits\HasPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasPermissions; // ANOTAÇÃO: Usa o trait de permissões

    // ANOTAÇÃO: Adicionando relacionamentos
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // ANOTAÇÃO: Relação com turmas (professor pode ter várias turmas)
    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'professor_turma');
    }

    // ANOTAÇÃO: Verifica se é admin
    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }
}