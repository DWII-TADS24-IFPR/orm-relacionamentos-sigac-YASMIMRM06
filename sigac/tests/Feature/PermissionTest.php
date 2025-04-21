<?php
namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    // ANOTAÇÃO: Testa se admin pode gerenciar usuários
    public function test_admin_can_manage_users()
    {
        $admin = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($admin)
                         ->get('/admin/users');
        $response->assertStatus(200);
    }

    // ANOTAÇÃO: Testa se aluno não pode acessar admin
    public function test_student_cannot_access_admin()
    {
        $student = User::factory()->create(['role_id' => 3]);
        $response = $this->actingAs($student)
                         ->get('/admin/users');
        $response->assertStatus(403);
    }
}