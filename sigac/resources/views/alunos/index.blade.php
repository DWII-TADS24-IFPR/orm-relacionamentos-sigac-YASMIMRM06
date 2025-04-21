@extends('layouts.app')

@section('title', 'Lista de Alunos')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold">Alunos</h2>
    <a href="{{ route('alunos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Novo Aluno
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Curso</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Turma</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($alunos as $aluno)
            <tr>
                <td class="px-6 py-4">{{ $aluno->nome }}</td>
                <td class="px-6 py-4">{{ $aluno->curso->nome }}</td>
                <td class="px-6 py-4">{{ $aluno->turma->ano }}</td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('alunos.show', $aluno->id) }}" class="text-blue-600 hover:text-blue-800">Ver</a>
                    <a href="{{ route('alunos.edit', $aluno->id) }}" class="text-green-600 hover:text-green-800">Editar</a>
                    <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" class="inline">
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
    {{ $alunos->links() }}
</div>
@endsection