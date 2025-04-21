@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Curso</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $curso->nome }}</h5>
            <p class="card-text"><strong>Descrição:</strong> {{ $curso->descricao }}</p>
            <p class="card-text"><strong>Carga Horária:</strong> {{ $curso->carga_horaria }}h</p>
            <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </div>
    <a href="{{ route('cursos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection