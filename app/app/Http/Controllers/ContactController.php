<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log; 

class ContactController extends Controller
{
   
    public function index()
    {
        $contacts = Contact::latest()->paginate(10); 
        return view('dashboard', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Dados recebidos para cadastro de contato: ', $request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'required|string|max:20', 
            'status' => [
                'required',
                Rule::in(['Ativo', 'Inativo', 'Potencial']),
            ],
        ]);

        Contact::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Contato cadastrado com sucesso!');
    }


    public function show(Contact $contact)
    {
        return redirect()->route('dashboard')->with('info_contact', $contact); // Exemplo de como passar dados para exibir em um modal na dashboard
    }


    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact')); // Vamos criar uma view simples para edição.
    }

 
    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('contacts')->ignore($contact->id),
            ],
            'phone' => 'required|string|max:20',
            'status' => [
                'required',
                Rule::in(['Ativo', 'Inativo', 'Potencial']),
            ],
        ]);

        $contact->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Contato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('dashboard')->with('success', 'Contato excluído com sucesso!');
    }
}