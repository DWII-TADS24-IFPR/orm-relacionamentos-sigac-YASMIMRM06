**📒 Anotações da Aluna - Atualizações do Sistema**  

*"Oi prof! Seguem minhas anotações sobre as mudanças que implementei no sistema. Deixei tudo explicadinho com exemplos pra facilitar!"* ✨  
---

### **1. 🗂️ O que mudou na estrutura?**  
**Antes:**  
- Só tinha models básicos (User, Aluno, Turma)  
- Não controlava quem podia acessar o quê  

**Agora:**  
- **Pasta `Traits/`**: Apareceu! (É tipo um "superpoder" que podemos adicionar em várias classes)  
- **Novos arquivos**:  
  - `Role.php` (define cargos como *Admin*, *Professor*)  
  - `Permission.php` (controla quem pode *criar*, *editar*, etc.)  
  - `HasPermissions.php` (trait que eu uso nos Users pra verificar permissões)  

*Exemplo:*  
```php  
// No User.php agora tem:  
use HasPermissions; // Isso aqui dá superpoderes de permissão!  
```  

---

### **2. 🔄 Como funcionam as PERMISSÕES?**  
*(Desenhei mentalmente um esquema pra entender!)*  

| **Tabela**      | **O que guarda?** | **Exemplo** |  
|-----------------|-------------------|-------------|  
| `roles`         | Cargos            | Admin, Professor |  
| `permissions`   | Ações permitidas  | "gerenciar-alunos", "criar-turmas" |  
| `role_permission` | Qual cargo pode fazer o quê | Admin + "deletar-usuários" |  

**Como eu uso no código?**  
```php  
if ($user->hasPermission('editar-alunos')) {  
    // Se tiver a permissão, faz a ação  
}  
```  

---

### **3. 📌 Mudanças nos Models Existentes**  

#### **User.php**  
*(Antes só fazia login, agora faz muuuito mais!)*  
```php  
// Relação com cargos (1 usuário tem 1 cargo)  
public function role() {  
    return $this->belongsTo(Role::class);  
}  

// Relação com turmas (1 professor pode ter várias turmas)  
public function turmas() {  
    return $this->belongsToMany(Turma::class);  
}  
```  

#### **Aluno.php**  
*(Agora guarda documentos também!)*  
```php  
public function documentos() {  
    return $this->hasMany(Documento::class); // Um aluno tem muitos documentos  
}  
```  

---

### **4. 💾 Banco de Dados - Migrações Novas**  
*(Tive que criar tabelas novas no banco!)*  

| **Arquivo de Migração**           | **O que cria?** |  
|-----------------------------------|----------------|  
| `create_permission_tables.php`    | Tabelas de `roles`, `permissions` e como elas se relacionam |  
| `add_fields_to_users.php`         | Adiciona `role_id` em Users |  

*Comando pra atualizar o banco:*  
```bash  
php artisan migrate --seed  
```  

---

### **5. 🌱 Dados Iniciais (Seeders)**  
*(Populei o sistema com valores padrão!)*  

**RolePermissionSeeder.php**  
```php  
// Cria os cargos  
Role::create(['name' => 'admin', 'description' => 'Superpoderes!']);  

// Cria permissões  
Permission::create(['name' => 'gerenciar-alunos', 'description' => 'Pode add/editar alunos']);  

// Atribui permissões ao cargo Admin  
$adminRole->permissions()->attach([1, 2, 3]); // Admin pode TUDO  
```  

---

### **6. 🧪 Testando na Prática**  
*(não consegui executar o teste)*  

```php  
// Teste: Admin pode gerenciar usuários?  
$admin = User::where('role_id', 1)->first();  
if ($admin->hasPermission('gerenciar-usuários')) {  
    echo "Pode gerenciar!"; // Funcionou! 🎉  
}  
```  
---

### **7. ❓ Dúvidas que Ainda Tenho**  
1. Preciso criar uma interface pra gerenciar permissões? *(Talvez um CRUD?)*  
2. Como restringir rotas baseado em permissões? *(Preciso estudar Middlewares!)*  

--- 

**✏️ Observação Final:**  
*"Prof, adicionei comentários explicativos em todos os arquivos novos! Assim fica mais fácil para conseguir lembra o que mudei ou adicionei nos codigos.*"

*(Assinatura: Aluna Yasmim Russi)*