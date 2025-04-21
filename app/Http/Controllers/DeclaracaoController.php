<?php
// app/Http/Controllers/DeclaracaoController.php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeclaracaoController extends Controller
{
    /**
     * Retorna todas as declarações com paginação
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Carrega as relações para evitar queries adicionais (N+1 problem)
        $declaracoes = Declaracao::with(['aluno', 'comprovante'])
            ->orderBy('data', 'desc')
            ->paginate(10);

        return response()->json($declaracoes);
    }

    /**
     * Cria uma nova declaração
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'comprovante_id' => 'required|exists:comprovantes,id',
            'data' => 'required|date',
        ]);

        // Gera um hash único para a declaração
        $validated['hash'] = bin2hex(random_bytes(32));

        // Usamos transação para garantir integridade
        $declaracao = DB::transaction(function () use ($validated) {
            return Declaracao::create($validated);
        });

        return response()->json($declaracao, 201);
    }

    /**
     * Retorna uma declaração específica
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $declaracao = Declaracao::with(['aluno', 'comprovante'])
            ->findOrFail($id);

        return response()->json($declaracao);
    }

    /**
     * Atualiza uma declaração existente
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $declaracao = Declaracao::findOrFail($id);

        $validated = $request->validate([
            'data' => 'sometimes|date',
            // Não permitimos alterar aluno_id ou comprovante_id após criação
        ]);

        $declaracao->update($validated);

        return response()->json($declaracao);
    }

    /**
     * Remove uma declaração (soft delete)
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $declaracao = Declaracao::findOrFail($id);
        $declaracao->delete();

        return response()->json(null, 204);
    }

    /**
     * Restaura uma declaração excluída
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $declaracao = Declaracao::withTrashed()->findOrFail($id);
        $declaracao->restore();

        return response()->json($declaracao);
    }

    /**
     * Busca declarações por hash, aluno ou data
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = Declaracao::query();

        if ($request->has('hash')) {
            $query->where('hash', 'like', '%' . $request->hash . '%');
        }

        if ($request->has('aluno_id')) {
            $query->where('aluno_id', $request->aluno_id);
        }

        if ($request->has('data_inicio') && $request->has('data_fim')) {
            $query->whereBetween('data', [
                $request->data_inicio,
                $request->data_fim
            ]);
        }

        $resultados = $query->with(['aluno', 'comprovante'])
            ->paginate(10);

        return response()->json($resultados);
    }
}