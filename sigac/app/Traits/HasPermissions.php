<?php
namespace App\Traits;

// ANOTAÇÃO: Trait para adicionar funcionalidades de permissão aos usuários
trait HasPermissions
{
    // ANOTAÇÃO: Verifica se usuário tem permissão direta ou via papel
    public function hasPermission($permission)
    {
        return $this->permissions->contains('name', $permission) ||
               $this->roles->contains(function ($role) use ($permission) {
                   return $role->permissions->contains('name', $permission);
               });
    }

    // ANOTAÇÃO: Atribui permissões ao usuário
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getPermissions($permissions);
        $this->permissions()->saveMany($permissions);
    }
}