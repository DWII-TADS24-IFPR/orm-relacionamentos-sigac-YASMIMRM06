@extends('layouts.app')

@section('title', 'Detalhes do Aluno')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold">{{ $aluno->nome }}</h2>
                <p class="text-gray-600">{{ $aluno->curso->nome }} - Turma {{ $aluno->turma->ano }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('alunos.edit', $aluno->id) }}" class="text-blue-600 hover:text-blue-800">Editar</a>
                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza?')">Excluir</button>
                </form>
            </div>
        </div>
        
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="text-lg font-semibold mb-2">Informações Pessoais</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">CPF:</span> {{ $aluno->cpf }}</p>
                    <p><span class="font-medium">E-mail:</span> {{ $aluno->email }}</p>
                    <p><span class="font-medium">Data de Cadastro:</span> {{ $aluno->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-2">Progresso no Curso</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">Horas Totais:</span> {{ $aluno->total_horas }}h</p>
                    <p><span class="font-medium">Horas Necessárias:</span> {{ $aluno->curso->total_horas }}h</p>
                    @php
                        $percentual = min(100, ($aluno->total_horas / $aluno->curso->total_horas) * 100);
                    @endphp
                    <div>
                        <span class="font-medium">Progresso:</span>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentual }}%"></div>
                        </div>
                        <span class="text-sm">{{ number_format($percentual, 1) }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="border-t border-gray-200 px-6 py-4">
        <h3 class="text-lg font-semibold mb-4">Comprovantes</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Atividade</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($aluno->comprovantes as $comprovante)
                    <tr>
                        <td class="px-6 py-4">{{ $comprovante->atividade }}</td>
                        <td class="px-6 py-4">{{ $comprovante->categoria->nome }}</td>
                        <td class="px-6 py-4">{{ $comprovante->horas }}h</td>
                        <td class="px-6 py-4">{{ $comprovante->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('alunos.index') }}" class="text-blue-600 hover:text-blue-800">
        ← Voltar para lista de alunos
    </a>
</div>
@endsection