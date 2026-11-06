<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();

        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('alternatif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:alternatifs,kode',
            'nama' => 'required'
        ]);

        Alternatif::create($request->only('kode', 'nama'));

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil ditambahkan');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'kode' => 'required|unique:alternatifs,kode,' . $alternatif->id,
            'nama' => 'required'
        ]);

        $alternatif->update($request->only('kode', 'nama'));

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil diperbarui');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil dihapus');
    }
}