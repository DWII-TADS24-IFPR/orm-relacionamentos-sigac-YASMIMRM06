<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // ANOTAÇÃO: Cria papéis básicos
        $adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Administrador do sistema'
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher', 
            'description' => 'Professor'
        ]);

        // ANOTAÇÃO: Cria permissões comuns
        $permissions = [
            'manage-users' => 'Gerenciar usuários',
            'manage-courses' => 'Gerenciar cursos',
            'view-reports' => 'Visualizar relatórios'
        ];

        foreach ($permissions as $name => $desc) {
            Permission::create(['name' => $name, 'description' => $desc]);
        }

        // ANOTAÇÃO: Atribui todas permissões ao admin
        $adminRole->permissions()->attach(Permission::all());
    }
}