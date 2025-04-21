@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Total de Alunos</h3>
        <p class="text-3xl font-bold">{{ $totalAlunos }}</p>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Total de Cursos</h3>
        <p class="text-3xl font-bold">{{ $totalCursos }}</p>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Total de Comprovantes</h3>
        <p class="text-3xl font-bold">{{ $totalComprovantes }}</p>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">Últimos Comprovantes</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Aluno</th>
                    <th class="text-left py-2">Atividade</th>
                    <th class="text-left py-2">Horas</th>
                    <th class="text-left py-2">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ultimosComprovantes as $comprovante)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2">{{ $comprovante->aluno->nome }}</td>
                    <td class="py-2">{{ Str::limit($comprovante->atividade, 30) }}</td>
                    <td class="py-2">{{ $comprovante->horas }}h</td>
                    <td class="py-2">{{ $comprovante->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection