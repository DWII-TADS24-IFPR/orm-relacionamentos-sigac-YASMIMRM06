@extends('layouts.app')

@section('title', 'Cadastrar Comprovante')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Cadastrar Comprovante</h2>
    
    <form method="POST" action="{{ route('comprovantes.store') }}" class="bg-white p-6 rounded-lg shadow">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="aluno_id" class="block text-sm font-medium text-gray-700">Aluno</label>
                <select id="aluno_id" name="aluno_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Selecione um aluno</option>
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}">{{ $aluno->nome }} - {{ $aluno->curso->sigla }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                <select id="categoria_id" name="categoria_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Selecione uma categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }} ({{ $categoria->curso->sigla }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mb-4">
            <label for="atividade" class="block text-sm font-medium text-gray-700">Atividade</label>
            <input type="text" id="atividade" name="atividade" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="horas" class="block text-sm font-medium text-gray-700">Horas</label>
            <input type="number" step="0.1" id="horas" name="horas" required min="0.1"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('comprovantes.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Salvar Comprovante
            </button>
        </div>
    </form>
</div>
@endsection