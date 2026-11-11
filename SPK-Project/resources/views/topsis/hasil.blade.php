
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Hasil Perhitungan TOPSIS</h3>

    {{-- Matriks Keputusan X --}}
    <div class="card mb-4">
        <div class="card-header">1. Matriks Keputusan (X)</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriteria as $k)
                            <th>{{ $k->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $a)
                        <tr>
                            <td>{{ $a->nama }}</td>
                            @foreach($kriteria as $k)
                                <td>{{ number_format($X[$a->id][$k->id], 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Matriks Normalisasi R --}}
    <div class="card mb-4">
        <div class="card-header">2. Matriks Normalisasi (R)</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriteria as $k)
                            <th>{{ $k->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $a)
                        <tr>
                            <td>{{ $a->nama }}</td>
                            @foreach($kriteria as $k)
                                <td>{{ number_format($R[$a->id][$k->id], 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Matriks Terbobot V --}}
    <div class="card mb-4">
        <div class="card-header">3. Matriks Normalisasi Terbobot (V)</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriteria as $k)
                            <th>{{ $k->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $a)
                        <tr>
                            <td>{{ $a->nama }}</td>
                            @foreach($kriteria as $k)
                                <td>{{ number_format($V[$a->id][$k->id], 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Solusi Ideal --}}
    <div class="card mb-4">
        <div class="card-header">4. Solusi Ideal Positif dan Negatif</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Solusi</th>
                        @foreach($kriteria as $k)
                            <th>{{ $k->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>A+</th>
                        @foreach($kriteria as $k)
                            <td>{{ number_format($Aplus[$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>A-</th>
                        @foreach($kriteria as $k)
                            <td>{{ number_format($Aminus[$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Jarak dan Ranking --}}
    <div class="card mb-4">
        <div class="card-header">5. Hasil Perangkingan</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>Alternatif</th>
                        <th>A+</th>
                        <th>A-</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasil as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ number_format($item['dplus'], 4) }}</td>
                            <td>{{ number_format($item['dminus'], 4) }}</td>
                            <td>
                                <strong>
                                    {{ number_format($item['nilai'], 4) }}
                                </strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('topsis.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</div>

@endsection
