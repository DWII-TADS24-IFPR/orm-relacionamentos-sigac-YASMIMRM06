<?php
// app/Http/Controllers/AlunoController.php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{
    /**
     * Mostra todos os alunos cadastrados no sistema
     * Com paginação de 10 registros por página
     */
    public function index()
    {
        // Carrega os relacionamentos para evitar muitas queries (problema N+1)
        $alunos = Aluno::with(['curso', 'turma', 'user'])
            ->orderBy('nome') // Ordena por nome
            ->paginate(10); // Paginação

        return response()->json($alunos);
    }

    /**
     * Cria um novo aluno no sistema
     * Valida os dados antes de criar
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:150',
            'cpf' => 'required|string|size:11|unique:alunos',
            'email' => 'required|email|unique:alunos',
            'senha' => 'required|string|min:6',
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
            'user_id' => 'required|exists:users,id'
        ]);

        // Criptografa a senha antes de salvar
        $dados = $request->all();
        $dados['senha'] = Hash::make($request->senha);

        // Cria o aluno
        $aluno = Aluno::create($dados);

        // Retorna o aluno criado com status 201 (Created)
        return response()->json($aluno, 201);
    }

    /**
     * Mostra os detalhes de um aluno específico
     */
    public function show($id)
    {
        // Busca o aluno ou retorna 404 se não encontrar
        $aluno = Aluno::with(['curso', 'turma', 'user'])
            ->findOrFail($id);

        return response()->json($aluno);
    }

    /**
     * Atualiza os dados de um aluno
     */
    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);

        // Validação (cpf e email são únicos, mas ignorando o próprio registro)
        $request->validate([
            'nome' => 'sometimes|string|max:150',
            'cpf' => 'sometimes|string|size:11|unique:alunos,cpf,'.$aluno->id,
            'email' => 'sometimes|email|unique:alunos,email,'.$aluno->id,
            'senha' => 'sometimes|string|min:6',
            'curso_id' => 'sometimes|exists:cursos,id',
            'turma_id' => 'sometimes|exists:turmas,id'
        ]);

        // Atualiza os dados
        $aluno->update($request->all());

        return response()->json($aluno);
    }

    /**
     * Remove um aluno (soft delete)
     */
    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete(); // Soft delete

        // Retorna resposta vazia com status 204 (No Content)
        return response()->json(null, 204);
    }

    /**
     * Restaura um aluno que foi excluído
     */
    public function restore($id)
    {
        $aluno = Aluno::withTrashed()->findOrFail($id);
        $aluno->restore();

        return response()->json($aluno);
    }

    /**
     * Busca alunos por nome, CPF ou email
     */
    public function search(Request $request)
    {
        $query = Aluno::query();

        if ($request->nome) {
            $query->where('nome', 'like', '%'.$request->nome.'%');
        }

        if ($request->cpf) {
            $query->where('cpf', $request->cpf);
        }

        if ($request->email) {
            $query->where('email', $request->email);
        }

        $alunos = $query->with(['curso', 'turma'])
            ->paginate(10);

        return response()->json($alunos);
    }
}