
@extends('layouts.app')

@section('content')

<h4>Tambah Alternatif</h4>

<form action="{{ route('alternatif.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Kode Alternatif</label>
        <input type="text" name="kode" class="form-control"
               placeholder="A1" required>
    </div>

    <div class="mb-3">
        <label>Nama Alternatif</label>
        <input type="text" name="nama" class="form-control"
               placeholder="Ngemplak" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('alternatif.index') }}"
       class="btn btn-secondary">Kembali</a>
</form>

@endsection
