<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl">Contatos</h2>
        <button onclick="toggleModal()" class="px-4 py-2 bg-green-600 text-white rounded">Novo Contato</button>
    </div>

    <!-- Tabela de Contatos -->
    <table class="w-full border-collapse border text-center">
        <thead>
            <tr>
                <th class="border p-2 align-middle">Nome</th>
                <th class="border p-2 align-middle">E-mail</th>
                <th class="border p-2 align-middle">Telefone</th>
                <th class="border p-2 align-middle">Status</th>
                <th class="border p-2 align-middle">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td class="border p-2 align-middle">{{ $contact->name }}</td>
                    <td class="border p-2 align-middle">{{ $contact->email }}</td>
                    <td class="border p-2 align-middle">{{ $contact->phone }}</td>
                    <td class="border p-2 align-middle">
                        @php
                            $statusClasses = match($contact->status) {
                                'Ativo' => 'bg-green-100 text-green-800',
                                'Inativo' => 'bg-red-100 text-red-800',
                                'Potencial' => 'bg-yellow-100 text-yellow-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="px-2 py-1 rounded {{ $statusClasses }}">
                            {{ $contact->status }}
                        </span>
                    </td>
                    <td class="border p-2 align-middle space-x-2">
                        <button
                            onclick="openViewModal(this)"
                            data-name="{{ $contact->name }}"
                            data-email="{{ $contact->email }}"
                            data-phone="{{ $contact->phone }}"
                            data-status="{{ $contact->status }}"
                            title="Visualizar"
                        >
                            <i class="fas fa-eye text-blue-600 hover:text-blue-800"></i>
                        </button>
                        <a href="{{ route('contacts.edit', $contact) }}" title="Editar">
                            <i class="fas fa-pen text-green-600 hover:text-green-800"></i>
                        </a>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Confirma exclusão?')" title="Excluir">
                                <i class="fas fa-trash text-red-600 hover:text-red-800"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>


<!-- Modal de Visualização -->
<div id="viewContactModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h3 class="text-xl mb-4">Visualizar Contato</h3>
        <div class="mb-4">
            <label>Nome completo</label>
            <input type="text" id="view-name" class="w-full border p-2" readonly>
        </div>
        <div class="mb-4">
            <label>E-mail</label>
            <input type="email" id="view-email" class="w-full border p-2" readonly>
        </div>
        <div class="mb-4">
            <label>Telefone</label>
            <input type="text" id="view-phone" class="w-full border p-2" readonly>
        </div>
        <div class="mb-4">
            <label>Status</label>
            <input type="text" id="view-status" class="w-full border p-2" readonly>
        </div>
        <div class="flex justify-end">
            <button type="button" onclick="toggleViewModal()">Fechar</button>
        </div>
    </div>
</div>


<!-- Modal de Novo Contato -->
<div id="newContactModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h3 class="text-xl mb-4">Novo Contato</h3>
        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <div class="mb-4">
                <label>Nome completo</label>
                <input type="text" name="name" class="w-full border p-2" required value="{{ old('name') }}">
            </div>
            <div class="mb-4">
                <label>E-mail</label>
                <input type="email" name="email" class="w-full border p-2" required  value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label>Telefone</label>
                <input type="text" name="phone" class="w-full border p-2" required value="{{ old('phone') }}">
            </div>
            <div class="mb-4">
                <label>Status</label>
                <select name="status" class="w-full border p-2">
                    <option value="Potencial" selected>Potencial</option>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="toggleModal()" class="mr-2">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>

function toggleModal() {
    const modal = document.getElementById('newContactModal');
    modal.classList.toggle('hidden');
}

function toggleViewModal() {
    const modal = document.getElementById('viewContactModal');
    modal.classList.toggle('hidden');
}

function openViewModal(button) {
    document.getElementById('view-name').value = button.getAttribute('data-name');
    document.getElementById('view-email').value = button.getAttribute('data-email');
    document.getElementById('view-phone').value = button.getAttribute('data-phone');
    document.getElementById('view-status').value = button.getAttribute('data-status');
    toggleViewModal();
}

</script>
@endsection
