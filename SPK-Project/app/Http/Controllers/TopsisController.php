<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;

class TopsisController extends Controller
{
    public function index()
    {
        return view('topsis.index');
    }

    public function hitung()
    {
        $alternatifs = Alternatif::with('kriteria')->get();
        $kriteria = Kriteria::orderBy('id')->get();

        if ($alternatifs->isEmpty() || $kriteria->isEmpty()) {
            return redirect()->route('topsis.index')
                ->with('error', 'Data belum tersedia.');
        }

        // 1. Matriks keputusan X
        $X = [];

        foreach ($alternatifs as $a) {
            foreach ($kriteria as $k) {
                $nilai = $a->kriteria->firstWhere('id', $k->id);

                if (!$nilai) {
                    return redirect()->route('nilai.index')
                        ->with('error', 'Nilai alternatif belum lengkap.');
                }

                $X[$a->id][$k->id] = $nilai->pivot->skor;
            }
        }

        // 2. Normalisasi R
        $R = [];

        foreach ($kriteria as $k) {

            $total = 0;

            foreach ($alternatifs as $a) {
                $total += pow($X[$a->id][$k->id], 2);
            }

            $total = sqrt($total);

            foreach ($alternatifs as $a) {
                $R[$a->id][$k->id] = $total == 0
                    ? 0
                    : $X[$a->id][$k->id] / $total;
            }
        }

        // 3. Normalisasi bobot
        $totalBobot = $kriteria->sum('bobot');

        if ($totalBobot <= 0) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Total bobot harus lebih dari 0.');
        }

        $V = [];

        foreach ($alternatifs as $a) {
            foreach ($kriteria as $k) {
                $V[$a->id][$k->id] =
                    $R[$a->id][$k->id] * ($k->bobot / $totalBobot);
            }
        }

        // 4. Solusi ideal positif dan negatif
        $Aplus = [];
        $Aminus = [];

        foreach ($kriteria as $k) {

            $nilai = [];

            foreach ($alternatifs as $a) {
                $nilai[] = $V[$a->id][$k->id];
            }

            if ($k->jenis == 'benefit') {
                $Aplus[$k->id] = max($nilai);
                $Aminus[$k->id] = min($nilai);
            } else {
                $Aplus[$k->id] = min($nilai);
                $Aminus[$k->id] = max($nilai);
            }
        }

        // 5. Menghitung jarak solusi ideal
        $Dplus = [];
        $Dminus = [];

        foreach ($alternatifs as $a) {

            $plus = 0;
            $minus = 0;

            foreach ($kriteria as $k) {
                $plus += pow($V[$a->id][$k->id] - $Aplus[$k->id], 2);
                $minus += pow($V[$a->id][$k->id] - $Aminus[$k->id], 2);
            }

            $Dplus[$a->id] = sqrt($plus);
            $Dminus[$a->id] = sqrt($minus);
        }

        // 6. Menghitung nilai preferensi
        $hasil = [];

        foreach ($alternatifs as $a) {

            $total = $Dplus[$a->id] + $Dminus[$a->id];

            $hasil[] = [
                'id' => $a->id,
                'nama' => $a->nama,
                'dplus' => $Dplus[$a->id],
                'dminus' => $Dminus[$a->id],
                'nilai' => $total == 0 ? 0 : $Dminus[$a->id] / $total
            ];
        }

        // 7. Ranking
        usort($hasil, fn($a, $b) => $b['nilai'] <=> $a['nilai']);

        return view('topsis.hasil', compact(
            'alternatifs', 'kriteria', 'X', 'R', 'V',
            'Aplus', 'Aminus', 'Dplus', 'Dminus', 'hasil'
        ));
    }
}