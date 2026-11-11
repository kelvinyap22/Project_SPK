
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Data Kriteria</h3>

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

    <div class="card mb-4">
        <div class="card-header">
            Tambah Kriteria
        </div>

        <div class="card-body">

            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Kriteria</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           maxlength="45"
                           placeholder="Contoh: Jarak Pasar"
                           required>
                </div>

                <div class="mb-3">
                    <label>Bobot</label>
                    <input type="number"
                           name="bobot"
                           class="form-control"
                           min="0"
                           step="any"
                           required>
                </div>

                <div class="mb-3">
                    <label>Jenis Kriteria</label>
                    <select name="jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="benefit">Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                </div>

                <button class="btn btn-primary">
                    Tambah Kriteria
                </button>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Daftar Kriteria
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($kriteria as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->nama }}</td>

                            <td>{{ $item->bobot }}</td>

                            <td>
                                @if($item->jenis == 'benefit')
                                    <span class="badge bg-success">Benefit</span>
                                @else
                                    <span class="badge bg-danger">Cost</span>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('kriteria.update', $item->id) }}"
                                      method="POST"
                                      class="mb-2">

                                    @csrf
                                    @method('PUT')

                                    <input type="text"
                                           name="nama"
                                           value="{{ $item->nama }}"
                                           class="form-control mb-2"
                                           maxlength="45"
                                           required>

                                    <input type="number"
                                           name="bobot"
                                           value="{{ $item->bobot }}"
                                           class="form-control mb-2"
                                           min="0"
                                           step="any"
                                           required>

                                    <select name="jenis"
                                            class="form-select mb-2"
                                            required>

                                        <option value="benefit"
                                            {{ $item->jenis == 'benefit' ? 'selected' : '' }}>
                                            Benefit
                                        </option>

                                        <option value="cost"
                                            {{ $item->jenis == 'cost' ? 'selected' : '' }}>
                                            Cost
                                        </option>

                                    </select>

                                    <button class="btn btn-warning btn-sm">
                                        Simpan Perubahan
                                    </button>
                                </form>

                                <form action="{{ route('kriteria.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>

                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada kriteria.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
