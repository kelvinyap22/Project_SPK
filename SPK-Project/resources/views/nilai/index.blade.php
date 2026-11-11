
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Input Nilai Alternatif</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if($alternatifs->isEmpty() || $kriteria->isEmpty())
        <div class="alert alert-warning">
            Tambahkan alternatif dan kriteria terlebih dahulu.
        </div>
    @else

        <form action="{{ route('nilai.store') }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-header">
                    Matriks Nilai Alternatif
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Alternatif</th>

                                @foreach($kriteria as $k)
                                    <th>
                                        {{ $k->nama }}
                                        <br>
                                        <small>
                                            {{ ucfirst($k->jenis) }}
                                        </small>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($alternatifs as $alternatif)

                                <tr>
                                    <td class="text-start">
                                        {{ $alternatif->nama }}
                                    </td>

                                    @foreach($kriteria as $k)

                                        @php
                                            $nilai = $alternatif->kriteria
                                                ->firstWhere('id', $k->id);
                                        @endphp

                                        <td>
                                            <input type="number"
                                                name="nilai[{{ $alternatif->id }}][{{ $k->id }}]"
                                                class="form-control"
                                                step="any"
                                                min="0"
                                                value="{{ $nilai ? $nilai->pivot->skor : '' }}"
                                                required>
                                        </td>

                                    @endforeach
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">
                        Simpan Nilai
                    </button>

                </div>
            </div>

        </form>

    @endif

</div>

@endsection
