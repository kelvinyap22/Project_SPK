
@extends('layouts.app')

@section('content')

<h4>Edit Alternatif</h4>

<form action="{{ route('alternatif.update', $alternatif->id) }}"
      method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Kode</label>
        <input type="text" name="kode" class="form-control"
               value="{{ $alternatif->kode }}" required>
    </div>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control"
               value="{{ $alternatif->nama }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
