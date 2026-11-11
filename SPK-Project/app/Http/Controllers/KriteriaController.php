<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KriteriaController extends Controller
{
    public function index()
    {
        return view('kriteria.index', [
            'kriteria' => Kriteria::orderBy('id')->get()
        ]);
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:45|unique:attribute,nama',
            'bobot' => 'required|numeric|min:0',
            'jenis' => 'required|in:benefit,cost'
        ]);

        Kriteria::create($request->only('nama', 'bobot', 'jenis'));

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('kriteria.show', [
            'kriteria' => Kriteria::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('kriteria.edit', [
            'kriteria' => Kriteria::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:45',
                Rule::unique('attribute', 'nama')->ignore($id)
            ],
            'bobot' => 'required|numeric|min:0',
            'jenis' => 'required|in:benefit,cost'
        ]);

        $kriteria->update($request->only('nama', 'bobot', 'jenis'));

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $kriteria->alternatif()->detach();
        $kriteria->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus.');
    }
}
