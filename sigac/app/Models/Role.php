<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // ANOTAÇÃO: Define quais campos podem ser preenchidos em massa
    protected $fillable = ['name', 'description'];

    // ANOTAÇÃO: Um papel pode ter muitos usuários
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // ANOTAÇÃO: Relação muitos-para-muitos com permissões
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    
    // ANOTAÇÃO: Método para verificar se o papel tem uma permissão
    public function hasPermission($permission)
    {
        return $this->permissions->contains('name', $permission);
    }
}