<?php
// routes/api.php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas da API
|--------------------------------------------------------------------------
|
| Aqui estão todas as rotas da API do sistema SIGAC. Todas as rotas são
| prefixadas com '/api' automaticamente pelo Laravel.
|
*/

// Grupo de rotas com middleware de autenticação
Route::middleware(['auth:api'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Rotas de Alunos
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de alunos do sistema
    | URI: /api/alunos
    |
    */
    Route::prefix('alunos')->group(function () {
        // Listar todos alunos (GET /api/alunos)
        Route::get('/', 'App\Http\Controllers\AlunoController@index')
            ->name('alunos.index')
            ->middleware('can:viewAny,App\Models\Aluno');
        
        // Criar novo aluno (POST /api/alunos)
        Route::post('/', 'App\Http\Controllers\AlunoController@store')
            ->name('alunos.store')
            ->middleware('can:create,App\Models\Aluno');
        
        // Mostrar aluno específico (GET /api/alunos/{id})
        Route::get('/{id}', 'App\Http\Controllers\AlunoController@show')
            ->name('alunos.show')
            ->middleware('can:view,aluno');
        
        // Atualizar aluno (PUT /api/alunos/{id})
        Route::put('/{id}', 'App\Http\Controllers\AlunoController@update')
            ->name('alunos.update')
            ->middleware('can:update,aluno');
        
        // Remover aluno (DELETE /api/alunos/{id})
        Route::delete('/{id}', 'App\Http\Controllers\AlunoController@destroy')
            ->name('alunos.destroy')
            ->middleware('can:delete,aluno');
        
        // Restaurar aluno excluído (POST /api/alunos/{id}/restore)
        Route::post('/{id}/restore', 'App\Http\Controllers\AlunoController@restore')
            ->name('alunos.restore')
            ->middleware('can:restore,aluno');
        
        // Buscar alunos (GET /api/alunos/search?termo=valor)
        Route::get('/search', 'App\Http\Controllers\AlunoController@search')
            ->name('alunos.search');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Categorias
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de categorias de atividades
    | URI: /api/categorias
    |
    */
    Route::prefix('categorias')->group(function () {
        Route::get('/', 'App\Http\Controllers\CategoriaController@index')->name('categorias.index');
        Route::post('/', 'App\Http\Controllers\CategoriaController@store')->name('categorias.store');
        Route::get('/{id}', 'App\Http\Controllers\CategoriaController@show')->name('categorias.show');
        Route::put('/{id}', 'App\Http\Controllers\CategoriaController@update')->name('categorias.update');
        Route::delete('/{id}', 'App\Http\Controllers\CategoriaController@destroy')->name('categorias.destroy');
        Route::post('/{id}/restore', 'App\Http\Controllers\CategoriaController@restore')->name('categorias.restore');
        
        // Listar categorias por curso (GET /api/cursos/{cursoId}/categorias)
        Route::get('/cursos/{cursoId}/categorias', 'App\Http\Controllers\CategoriaController@porCurso')
            ->name('categorias.porCurso');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Comprovantes
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de comprovantes de atividades
    | URI: /api/comprovantes
    |
    */
    Route::prefix('comprovantes')->group(function () {
        Route::get('/', 'App\Http\Controllers\ComprovanteController@index')->name('comprovantes.index');
        Route::post('/', 'App\Http\Controllers\ComprovanteController@store')->name('comprovantes.store');
        Route::get('/{id}', 'App\Http\Controllers\ComprovanteController@show')->name('comprovantes.show');
        Route::put('/{id}', 'App\Http\Controllers\ComprovanteController@update')->name('comprovantes.update');
        Route::delete('/{id}', 'App\Http\Controllers\ComprovanteController@destroy')->name('comprovantes.destroy');
        Route::post('/{id}/restore', 'App\Http\Controllers\ComprovanteController@restore')->name('comprovantes.restore');
        
        // Listar comprovantes por aluno (GET /api/alunos/{alunoId}/comprovantes)
        Route::get('/alunos/{alunoId}/comprovantes', 'App\Http\Controllers\ComprovanteController@porAluno')
            ->name('comprovantes.porAluno');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Cursos
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de cursos
    | URI: /api/cursos
    |
    */
    Route::prefix('cursos')->group(function () {
        Route::get('/', 'App\Http\Controllers\CursoController@index')->name('cursos.index');
        Route::post('/', 'App\Http\Controllers\CursoController@store')->name('cursos.store');
        Route::get('/{id}', 'App\Http\Controllers\CursoController@show')->name('cursos.show');
        Route::put('/{id}', 'App\Http\Controllers\CursoController@update')->name('cursos.update');
        Route::delete('/{id}', 'App\Http\Controllers\CursoController@destroy')->name('cursos.destroy');
        Route::post('/{id}/restore', 'App\Http\Controllers\CursoController@restore')->name('cursos.restore');
        
        // Listar cursos por eixo (GET /api/eixos/{eixoId}/cursos)
        Route::get('/eixos/{eixoId}/cursos', 'App\Http\Controllers\CursoController@porEixo')
            ->name('cursos.porEixo');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Turmas
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de turmas
    | URI: /api/turmas
    |
    */
    Route::prefix('turmas')->group(function () {
        Route::get('/', 'App\Http\Controllers\TurmaController@index')->name('turmas.index');
        Route::post('/', 'App\Http\Controllers\TurmaController@store')->name('turmas.store');
        Route::get('/{id}', 'App\Http\Controllers\TurmaController@show')->name('turmas.show');
        Route::put('/{id}', 'App\Http\Controllers\TurmaController@update')->name('turmas.update');
        Route::delete('/{id}', 'App\Http\Controllers\TurmaController@destroy')->name('turmas.destroy');
        Route::post('/{id}/restore', 'App\Http\Controllers\TurmaController@restore')->name('turmas.restore');
        
        // Listar turmas por curso (GET /api/cursos/{cursoId}/turmas)
        Route::get('/cursos/{cursoId}/turmas', 'App\Http\Controllers\TurmaController@porCurso')
            ->name('turmas.porCurso');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Níveis
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de níveis educacionais
    | URI: /api/niveis
    |
    */
    Route::prefix('niveis')->group(function () {
        Route::get('/', 'App\Http\Controllers\NivelController@index')->name('niveis.index');
        Route::post('/', 'App\Http\Controllers\NivelController@store')->name('niveis.store');
        Route::get('/{id}', 'App\Http\Controllers\NivelController@show')->name('niveis.show');
        Route::put('/{id}', 'App\Http\Controllers\NivelController@update')->name('niveis.update');
        Route::delete('/{id}', 'App\Http\Controllers\NivelController@destroy')->name('niveis.destroy');
        Route::post('/{id}/restore', 'App\Http\Controllers\NivelController@restore')->name('niveis.restore');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Documentos
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de documentos comprobatórios
    | URI: /api/documentos
    |
    */
    Route::prefix('documentos')->group(function () {
        Route::get('/', 'App\Http\Controllers\DocumentoController@index')->name('documentos.index');
        Route::post('/', 'App\Http\Controllers\DocumentoController@store')->name('documentos.store');
        Route::get('/{id}', 'App\Http\Controllers\DocumentoController@show')->name('documentos.show');
        Route::put('/{id}', 'App\Http\Controllers\DocumentoController@update')->name('documentos.update');
        Route::delete('/{id}', 'App\Http\Controllers\DocumentoController@destroy')->name('documentos.destroy');
        Route::post('/{id}/restore', 'App\Http\Controllers\DocumentoController@restore')->name('documentos.restore');
        
        // Download de documento (GET /api/documentos/{id}/download)
        Route::get('/{id}/download', 'App\Http\Controllers\DocumentoController@download')
            ->name('documentos.download');
        
        // Aprovar documento (POST /api/documentos/{id}/aprovar)
        Route::post('/{id}/aprovar', 'App\Http\Controllers\DocumentoController@aprovar')
            ->name('documentos.aprovar');
        
        // Reprovar documento (POST /api/documentos/{id}/reprovar)
        Route::post('/{id}/reprovar', 'App\Http\Controllers\DocumentoController@reprovar')
            ->name('documentos.reprovar');
    });

    /*
    |--------------------------------------------------------------------------
    | Rotas de Declarações
    |--------------------------------------------------------------------------
    |
    | Rotas para gerenciamento de declarações emitidas
    | URI: /api/declaracoes
    |
    */
    Route::prefix('declaracoes')->group(function () {
        Route::get('/', 'App\Http\Controllers\DeclaracaoController@index')->name('declaracoes.index');
        Route::post('/', 'App\Http\Controllers\DeclaracaoController@store')->name('declaracoes.store');
        Route::get('/{id}', 'App\Http\Controllers\DeclaracaoController@show')->name('declaracoes.show');
        Route::put('/{id}', 'App\Http\Controllers\DeclaracaoController@update')->name('declaracoes.update');
        Route::delete('/{id}', 'App\Http\Controllers\DeclaracaoController@destroy')->name('declaracoes.destroy');
        Route::post('/{id}/restore', 'App\Http\Controllers\DeclaracaoController@restore')->name('declaracoes.restore');
        
        // Busca de declarações (GET /api/declaracoes/search?param=valor)
        Route::get('/search', 'App\Http\Controllers\DeclaracaoController@search')
            ->name('declaracoes.search');
    });
});

/*
|--------------------------------------------------------------------------
| Rotas Públicas (sem autenticação)
|--------------------------------------------------------------------------
|
| Rotas que podem ser acessadas sem autenticação
|
*/

// Rota de saúde da API (GET /api/health)
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
})->name('health');

// Rotas de autenticação (login, registro, etc.)
Route::prefix('auth')->group(function () {
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
    Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('auth.register');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout')->middleware('auth:api');
});