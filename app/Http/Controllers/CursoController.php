<?php
// app/Http/Controllers/CursoController.php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Lista todos cursos com níveis e eixos
     */
    public function index()
    {
        $cursos = Curso::with(['nivel', 'eixo'])
            ->orderBy('nome')
            ->paginate(10);

        return response()->json($cursos);
    }

    /**
     * Cria novo curso
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:150',
            'sigla' => 'required|string|max:10',
            'total_horas' => 'required|numeric|min:0',
            'nivel_id' => 'required|exists:nivels,id',
            'eixo_id' => 'required|exists:eixos,id'
        ]);

        $curso = Curso::create($request->all());

        return response()->json($curso, 201);
    }

    /**
     * Mostra um curso específico
     */
    public function show($id)
    {
        $curso = Curso::with(['nivel', 'eixo', 'turmas', 'alunos'])
            ->findOrFail($id);

        return response()->json($curso);
    }

    /**
     * Atualiza um curso
     */
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);

        $request->validate([
            'nome' => 'sometimes|string|max:150',
            'sigla' => 'sometimes|string|max:10',
            'total_horas' => 'sometimes|numeric|min:0',
            'nivel_id' => 'sometimes|exists:nivels,id',
            'eixo_id' => 'sometimes|exists:eixos,id'
        ]);

        $curso->update($request->all());

        return response()->json($curso);
    }

    /**
     * Remove um curso (soft delete)
     */
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return response()->json(null, 204);
    }

    /**
     * Restaura curso excluído
     */
    public function restore($id)
    {
        $curso = Curso::withTrashed()->findOrFail($id);
        $curso->restore();

        return response()->json($curso);
    }

    /**
     * Lista cursos por eixo
     */
    public function porEixo($eixoId)
    {
        $cursos = Curso::where('eixo_id', $eixoId)
            ->with(['nivel'])
            ->orderBy('nome')
            ->get();

        return response()->json($cursos);
    }
}