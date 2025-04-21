@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
<div class="max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">Editar Categoria</h2>
    
    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}" class="bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $categoria->nome) }}" required
                   class="mt-1 block w-full rounded-md border-gray-300