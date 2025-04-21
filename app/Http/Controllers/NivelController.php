<?php
// app/Http/Controllers/NivelController.php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    /**
     * Lista todos níveis
     */
    public function index()
    {
        $niveis = Nivel::orderBy('nome')
            ->paginate(10);

        return response()->json($niveis);
    }

    /**
     * Cria novo nível
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:nivels'
        ]);

        $nivel = Nivel::create($request->all());

        return response()->json($nivel, 201);
    }

    /**
     * Mostra um nível específico
     */
    public function show($id)
    {
        $nivel = Nivel::findOrFail($id);

        return response()->json($nivel);
    }

    /**
     * Atualiza um nível
     */
    public function update(Request $request, $id)
    {
        $nivel = Nivel::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:100|unique:nivels,nome,'.$id
        ]);

        $nivel->update($request->all());

        return response()->json($nivel);
    }

    /**
     * Remove um nível (soft delete)
     */
    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->delete();

        return response()->json(null, 204);
    }

    /**
     * Restaura nível excluído
     */
    public function restore($id)
    {
        $nivel = Nivel::withTrashed()->findOrFail($id);
        $nivel->restore();

        return response()->json($nivel);
    }
}