@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Declaração</h1>
    <form action="{{ route('declaracoes.update', $declaracao->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select class="form-control" id="aluno_id" name="aluno_id" required>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}" {{ $declaracao->aluno_id == $aluno->id ? 'selected' : '' }}>
                        {{ $aluno->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="matricula" {{ $declaracao->tipo == 'matricula' ? 'selected' : '' }}>Matrícula</option>
                <option value="conclusao" {{ $declaracao->tipo == 'conclusao' ? 'selected' : '' }}>Conclusão</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="observacao" class="form-label">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" rows="3">{{ $declaracao->observacao }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('declaracoes.show', $declaracao->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection