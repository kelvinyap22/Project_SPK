
@extends('layouts.app')

@section('content')

<h4>Edit Kriteria</h4>

<form action="{{ route('kriteria.update', $kriteria->id) }}"
      method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Kode</label>
        <input name="kode" class="form-control"
               value="{{ $kriteria->kode }}" required>
    </div>

    <div class="mb-3">
        <label>Nama</label>
        <input name="nama" class="form-control"
               value="{{ $kriteria->nama }}" required>
    </div>

    <div class="mb-3">
        <label>Bobot</label>
        <input type="number" step="any" min="0"
               name="bobot" class="form-control"
               value="{{ $kriteria->bobot }}" required>
    </div>

    <div class="mb-3">
        <label>Jenis</label>
        <select name="jenis" class="form-select">
            <option value="benefit"
                {{ $kriteria->jenis == 'benefit' ? 'selected' : '' }}>
                Benefit
            </option>

            <option value="cost"
                {{ $kriteria->jenis == 'cost' ? 'selected' : '' }}>
                Cost
            </option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
