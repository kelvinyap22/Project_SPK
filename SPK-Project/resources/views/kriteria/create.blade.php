
@extends('layouts.app')

@section('content')

<h4>Tambah Kriteria</h4>

<form action="{{ route('kriteria.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Kode</label>
        <input name="kode" class="form-control"
               placeholder="C1" required>
    </div>

    <div class="mb-3">
        <label>Nama Kriteria</label>
        <input name="nama" class="form-control"
               placeholder="Jarak dengan pasar" required>
    </div>

    <div class="mb-3">
        <label>Bobot</label>
        <input type="number" step="any" min="0"
               name="bobot" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jenis Kriteria</label>
        <select name="jenis" class="form-select" required>
            <option value="benefit">Benefit</option>
            <option value="cost">Cost</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
