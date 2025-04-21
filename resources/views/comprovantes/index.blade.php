@extends('layouts.app')

@section('title', 'Comprovantes')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold">Comprovantes</h2>
    <a href="{{ route('comprovantes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Novo Comprovante
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aluno</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Atividade</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($comprovantes as $comprovante)
            <tr>
                <td class="px-6 py-4">{{ $comprovante->aluno->nome }}</td>
                <td class="px-6 py-4">{{ Str::limit($comprovante->atividade, 30) }}</td>
                <td class="px-6 py-4">{{ $comprovante->horas }}h</td>
                <td class="px-6 py-4">{{ $comprovante->categoria->nome }}</td>
                <td class="px-6 py-4">{{ $comprovante->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('comprovantes.show', $comprovante->id) }}" class="text-blue-600 hover:text-blue-800">Ver</a>
                    <form action="{{ route('comprovantes.destroy', $comprovante->id) }}" method="POST" class="inline">
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
    {{ $comprovantes->links() }}
</div>
@endsection