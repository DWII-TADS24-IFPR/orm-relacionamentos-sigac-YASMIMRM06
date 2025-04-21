@extends('layouts.app')

@section('title', 'Lista de Cursos')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold">Cursos</h2>
    <a href="{{ route('cursos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Novo Curso
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sigla</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Carga Horária</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($cursos as $curso)
            <tr>
                <td class="px-6 py-4">{{ $curso->nome }}</td>
                <td class="px-6 py-4">{{ $curso->sigla }}</td>
                <td class="px-6 py-4">{{ $curso->total_horas }}h</td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('cursos.show', $curso->id) }}" class="text-blue-600 hover:text-blue-800">Ver</a>
                    <a href="{{ route('cursos.edit', $curso->id) }}" class="text-green-600 hover:text-green-800">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="inline">
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
    {{ $cursos->links() }}
</div>
@endsection