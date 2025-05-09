@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl mb-4">Editar Contato</h2>
    <form method="POST" action="{{ route('contacts.update', $contact) }}" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nome completo</label>
            <input type="text" name="name" class="w-full border p-2 rounded" required value="{{ old('name', $contact->name) }}">
        </div>
        <div class="mb-4">
            <label>E-mail</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required value="{{ old('email', $contact->email) }}">
        </div>
        <div class="mb-4">
            <label>Telefone</label>
            <input type="text" name="phone" class="w-full border p-2 rounded" required value="{{ old('phone', $contact->phone) }}">
        </div>
        <div class="mb-4">
            <label>Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="Potencial" {{ $contact->status == 'Potencial' ? 'selected' : '' }}>Potencial</option>
                <option value="Ativo" {{ $contact->status == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="Inativo" {{ $contact->status == 'Inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('contacts.index') }}" class="mr-5 bg-red-600 text-white px-4 py-2 rounded">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
        </div>
    </form>
</div>

@endsection
