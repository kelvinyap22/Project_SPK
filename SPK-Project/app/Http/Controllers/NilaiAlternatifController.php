<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class NilaiAlternatifController extends Controller
{
    public function index()
    {
        return view('nilai.index', [
            'alternatifs' => Alternatif::with('kriteria')->get(),
            'kriteria' => Kriteria::orderBy('id')->get()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array'
        ]);

        foreach ($request->nilai as $alternatifId => $nilaiKriteria) {

            $alternatif = Alternatif::findOrFail($alternatifId);

            foreach ($nilaiKriteria as $kriteriaId => $skor) {

                if ($skor != '') {
                    $alternatif->kriteria()->syncWithoutDetaching([
                        $kriteriaId => ['skor' => $skor]
                    ]);
                }
            }
        }

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai alternatif berhasil disimpan.');
    }
}
