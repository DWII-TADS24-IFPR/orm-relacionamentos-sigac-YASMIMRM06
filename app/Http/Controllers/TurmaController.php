<?php
// app/Http/Controllers/TurmaController.php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    /**
     * Lista todas turmas com seus cursos
     */
    public function index()
    {
        $turmas = Turma::with('curso')
            ->orderByDesc('ano')
            ->paginate(10);

        return response()->json($turmas);
    }

    /**
     * Cria nova turma
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'ano' => 'required|integer|min:2000|max:2100'
        ]);

        // Verifica se já existe turma para este curso no mesmo ano
        $existe = Turma::where('curso_id', $request->curso_id)
            ->where('ano', $request->ano)
            ->exists();

        if ($existe) {
            return response()->json([
                'message' => 'Já existe uma turma para este curso no ano informado'
            ], 422);
        }

        $turma = Turma::create($request->all());

        return response()->json($turma, 201);
    }

    /**
     * Mostra uma turma específica
     */
    public function show($id)
    {
        $turma = Turma::with(['curso', 'alunos'])
            ->findOrFail($id);

        return response()->json($turma);
    }

    /**
     * Atualiza uma turma
     */
    public function update(Request $request, $id)
    {
        $turma = Turma::findOrFail($id);

        $request->validate([
            'curso_id' => 'sometimes|exists:cursos,id',
            'ano' => 'sometimes|integer|min:2000|max:2100'
        ]);

        // Verifica duplicação ao atualizar
        if ($request->has('curso_id') || $request->has('ano')) {
            $cursoId = $request->curso_id ?? $turma->curso_id;
            $ano = $request->ano ?? $turma->ano;

            $existe = Turma::where('curso_id', $cursoId)
                ->where('ano', $ano)
                ->where('id', '!=', $id)
                ->exists();

            if ($existe) {
                return response()->json([
                    'message' => 'Já existe uma turma para este curso no ano informado'
                ], 422);
            }
        }

        $turma->update($request->all());

        return response()->json($turma);
    }

    /**
     * Remove uma turma (soft delete)
     */
    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();

        return response()->json(null, 204);
    }

    /**
     * Restaura turma excluída
     */
    public function restore($id)
    {
        $turma = Turma::withTrashed()->findOrFail($id);
        $turma->restore();

        return response()->json($turma);
    }

    /**
     * Lista turmas de um curso específico
     */
    public function porCurso($cursoId)
    {
        $turmas = Turma::where('curso_id', $cursoId)
            ->with(['curso'])
            ->orderByDesc('ano')
            ->get();

        return response()->json($turmas);
    }
}