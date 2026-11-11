<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlternatifController extends Controller
{
    public function index()
    {
        return view('alternatif.index', [
            'alternatifs' => Alternatif::orderBy('id')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:45|unique:alternatif,nama'
        ]);

        Alternatif::create($request->only('nama'));

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:45',
                Rule::unique('alternatif', 'nama')->ignore($id)
            ]
        ]);

        $alternatif->update($request->only('nama'));

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $alternatif->kriteria()->detach();
        $alternatif->delete();

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil dihapus.');
    }
}
