# Anotações da Aluna - Atualizações do Sistema  

*"Oi prof! Seguem minhas anotações sobre as mudanças que implementei no sistema. Deixei tudo explicadinho com exemplos pra facilitar!"* ✨  

---

## Índice
1. [Estrutura do Sistema](#1-🗂️-o-que-mudou-na-estrutura)  
2. [Sistema de Permissões](#2-🔄-como-funcionam-as-permissões)  
3. [Mudanças nos Models](#3-📌-mudanças-nos-models-existentes)  
4. [Banco de Dados](#4-💾-banco-de-dados---migrações-novas)  
5. [Seeders](#5-🌱-dados-iniciais-seeders)  
6. [Testes](#6-🧪-testando-na-prática)  
7. [Relacionamentos](#📚-explicação-dos-relacionamentos-no-repositório)  
8. [Dúvidas](#7-❓-dúvidas-que-ainda-tenho)  

---

### 1. O que mudou na estrutura?  

**Antes:**  
- Models básicos (User, Aluno, Turma)  
- Sem controle de acesso granular  

**Agora:**  
```plaintext
app/
├── Traits/
│   └── HasPermissions.php  # Trait para gerenciar permissões
├── Models/
│   ├── Role.php            # Definição de cargos
│   ├── Permission.php      # Definição de permissões
│   └── ...                 # Outros models atualizados
```

**Principais adições:**  
- **Trait `HasPermissions`**: Reutilizável para verificar permissões  
- **Model `Role`**: Define hierarquia (Admin, Professor, etc.)  
- **Model `Permission`**: Controla ações específicas  

*Exemplo de uso:*  
```php
// User.php
use App\Traits\HasPermissions;

class User extends Authenticatable {
    use HasPermissions;  # Habilita sistema de permissões
}
```

---

### 2. Como funcionam as PERMISSÕES?  

**Estrutura do Banco:**  
| Tabela             | Descrição                  | Relacionamento         |
|--------------------|----------------------------|------------------------|
| `roles`            | Cargos do sistema          | -                      |
| `permissions`      | Ações permitidas           | -                      |
| `role_permission`  | Permissões por cargo       | Many-to-Many           |
| `users`            | Usuários                   | BelongsTo Role         |

**Métodos-chave:**  
```php
// Verifica permissão
$user->hasPermission('editar-alunos');

// Atribui permissão
$adminRole->permissions()->attach([1, 2]); 
```

---

### 3. Mudanças nos Models Existentes  

#### **User.php**  
```php
// Relações adicionadas
public function role() {
    return $this->belongsTo(Role::class);
}

public function turmas() {
    return $this->belongsToMany(Turma::class);
}
```

#### **Aluno.php**  
```php
// Novo relacionamento
public function documentos() {
    return $this->hasMany(Documento::class);
}
```

---

### 4.Banco de Dados - Migrações Novas  

**Arquivos criados:**  
- `create_permission_tables.php`  
- `add_fields_to_users.php`  

**Comando para atualizar:**  
```bash
php artisan migrate --seed
```

---

### 5.Dados Iniciais (Seeders)  

**RolePermissionSeeder.php**  
```php
$admin = Role::create([
    'name' => 'admin',
    'description' => 'Acesso total'
]);

Permission::create([
    'name' => 'gerenciar-usuários',
    'description' => 'Pode criar/editar usuários'
]);

$admin->permissions()->attach([1, 2]);  # Vincula permissões
```

---

### 6.Testando na Prática  

```php
$admin = User::with('role.permissions')->find(1);
if ($admin->can('gerenciar-usuários')) {
    // Lógica restrita
}
```

---

## Explicação dos Relacionamentos  

### Tipos Implementados:  
1. **One-to-One**: User ↔ Profile  
2. **One-to-Many**: Post ↔ Comment  
3. **Many-to-Many**: Student ↔ Class  

**Exemplo Many-to-Many:**  
```php
// Model Student
public function classes() {
    return $this->belongsToMany(ClassModel::class)
                ->withPivot('enrolled_at');
}
```

---

### 7. ❓ Dúvidas que Ainda Tenho  

1. Como implementar um CRUD para gerenciar permissões?  
2. Criar middlewares para proteção de rotas?  
   ```php
   Route::get('/admin')->middleware('can:gerenciar-admin');
   ```

--- 

** Observação Final:**  
*"Adicionei comentários detalhados em todos os arquivos modificados para facilitar a manutenção futura!"*  

*(Assinatura: Aluna Yasmim Russi)* 
