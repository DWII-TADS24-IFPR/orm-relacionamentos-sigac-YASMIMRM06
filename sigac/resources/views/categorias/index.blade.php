@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold">Categorias de Atividades</h2>
    <a href="{{ route('categorias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Nova Categoria
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Máximo de Horas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Curso</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($categorias as $categoria)
            <tr>
                <td class="px-6 py-4">{{ $categoria->nome }}</td>
                <td class="px-6 py-4">{{ $categoria->maximo_horas }}h</td>
                <td class="px-6 py-4">{{ $categoria->curso->nome }}</td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="text-green-600 hover:text-green-800">Editar</a>
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $categorias->links() }}
</div>
@endsection