<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// Rotas Públicas (acessíveis sem autenticação)
Route::middleware(['guest'])->group(function () {
    // Página de login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');
    
    // Processar login
    Route::post('/login', [LoginController::class, 'login']);
    
    // Página de registro (se aplicável)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');
    
    // Processar registro
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Página de recuperação de senha
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    
    // Página de redefinição de senha
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
});

// Rotas Protegidas (requerem autenticação)
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
    
    // Dashboard principal
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');
    
    /*
    |--------------------------------------------------------------------------
    | Rotas de Alunos
    |--------------------------------------------------------------------------
    */
    Route::prefix('alunos')->group(function () {
        Route::get('/', [AlunoController::class, 'index'])
            ->name('alunos.index')
            ->middleware('can:viewAny,App\Models\Aluno');
        
        Route::get('/create', [AlunoController::class, 'create'])
            ->name('alunos.create')
            ->middleware('can:create,App\Models\Aluno');
        
        Route::get('/{id}', [AlunoController::class, 'show'])
            ->name('alunos.show')
            ->middleware('can:view,aluno');
        
        Route::get('/{id}/edit', [AlunoController::class, 'edit'])
            ->name('alunos.edit')
            ->middleware('can:update,aluno');
        
        // Rotas para exportação/relatórios
        Route::get('/export', [AlunoController::class, 'export'])
            ->name('alunos.export');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Cursos
    |--------------------------------------------------------------------------
    */
    Route::prefix('cursos')->group(function () {
        Route::get('/', [CursoController::class, 'index'])
            ->name('cursos.index');
        
        Route::get('/create', [CursoController::class, 'create'])
            ->name('cursos.create');
        
        Route::get('/{id}', [CursoController::class, 'show'])
            ->name('cursos.show');
        
        Route::get('/{id}/edit', [CursoController::class, 'edit'])
            ->name('cursos.edit');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Comprovantes
    |--------------------------------------------------------------------------
    */
    Route::prefix('comprovantes')->group(function () {
        Route::get('/', [ComprovanteController::class, 'index'])
            ->name('comprovantes.index');
        
        Route::get('/create', [ComprovanteController::class, 'create'])
            ->name('comprovantes.create');
        
        Route::get('/{id}', [ComprovanteController::class, 'show'])
            ->name('comprovantes.show');
        
        // Upload de arquivos de comprovação
        Route::get('/{id}/upload', [ComprovanteController::class, 'showUploadForm'])
            ->name('comprovantes.upload');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Relatórios
    |--------------------------------------------------------------------------
    */
    Route::prefix('relatorios')->group(function () {
        Route::get('/horas-alunos', [RelatorioController::class, 'horasPorAluno'])
            ->name('relatorios.horas-alunos');
        
        Route::get('/horas-cursos', [RelatorioController::class, 'horasPorCurso'])
            ->name('relatorios.horas-cursos');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Configuração
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['can:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
        
        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users');
    });
});

/*
|--------------------------------------------------------------------------
| Rotas de Fallback (404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});