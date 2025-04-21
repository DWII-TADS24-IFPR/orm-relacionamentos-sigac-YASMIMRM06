@extends('layouts.app')

@section('title', 'Nova Categoria')

@section('content')
<div class="max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">Nova Categoria</h2>
    
    <form method="POST" action="{{ route('categorias.store') }}" class="bg-white p-6 rounded-lg shadow">
        @csrf
        
        <div class="mb-4">
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="maximo_horas" class="block text-sm font-medium text-gray-700">Máximo de Horas</label>
            <input type="number" step="0.1" id="maximo_horas" name="maximo_horas" required min="0.1"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="curso_id" class="block text-sm font-medium text-gray-700">Curso</label>
            <select id="curso_id" name="curso_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Selecione um curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nome }} ({{ $curso->sigla }})</option>
                @endforeach
            </select>
        </div>
        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('categorias.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Salvar Categoria
            </button>
        </div>
    </form>
</div>
@endsection