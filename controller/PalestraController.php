<?php

namespace App\Http\Controllers;

use App\Models\Palestra;
use Illuminate\Http\Request;

class PalestraController extends Controller
{
    private function validar(Request $request): array
    {
        return $request->validate([
            'titulo'      => ['required', 'min:3', 'max:255'],
            'palestrante' => ['required', 'min:3', 'max:255'],
            'data'        => ['required', 'date'],
            'local'       => ['required', 'min:2', 'max:255'],
            'descricao'   => ['nullable', 'min:3'],
        ]);
    }

    // Lista as palestras. Com ?editar=ID, o formulário vem preenchido.
    public function index(Request $request)
    {
        $palestras = Palestra::orderBy('data', 'desc')->get();
        $editando = $request->query('editar') ? Palestra::find($request->query('editar')) : null;

        return view('palestras', compact('palestras', 'editando'));
    }

    public function store(Request $request)
    {
        Palestra::create($this->validar($request));

        return redirect()->route('palestras.index')->with('sucesso', 'Palestra cadastrada!');
    }

    public function update(Request $request, Palestra $palestra)
    {
        $palestra->update($this->validar($request));

        return redirect()->route('palestras.index')->with('sucesso', 'Palestra atualizada!');
    }

    public function destroy(Palestra $palestra)
    {
        $palestra->delete();

        return redirect()->route('palestras.index')->with('sucesso', 'Palestra removida!');
    }
}
