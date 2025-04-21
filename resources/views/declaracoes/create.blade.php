@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Declaração</h1>
    <form action="{{ route('declaracoes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select class="form-control" id="aluno_id" name="aluno_id" required>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="matricula">Matrícula</option>
                <option value="conclusao">Conclusão</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Gerar Declaração</button>
        <a href="{{ route('declaracoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection