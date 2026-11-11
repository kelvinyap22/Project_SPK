
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Data Alternatif</h3>

    {{-- Pesan berhasil --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Alternatif --}}
    <div class="card mb-4">
        <div class="card-header">
            Tambah Alternatif
        </div>

        <div class="card-body">
            <form action="{{ route('alternatif.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Alternatif</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           placeholder="Contoh: Ngemplak"
                           maxlength="45"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
            </form>
        </div>
    </div>

    {{-- Tabel Alternatif --}}
    <div class="card">
        <div class="card-header">
            Daftar Alternatif
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Alternatif</th>
                        <th width="300">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($alternatifs as $alternatif)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $alternatif->nama }}
                            </td>

                            <td>
                                {{-- Form Edit --}}
                                <form action="{{ route('alternatif.update', $alternatif->id) }}"
                                      method="POST"
                                      class="d-flex gap-2 mb-2">
                                    @csrf
                                    @method('PUT')

                                    <input type="text"
                                           name="nama"
                                           class="form-control"
                                           value="{{ $alternatif->nama }}"
                                           maxlength="45"
                                           required>

                                    <button type="submit"
                                            class="btn btn-warning">
                                        Edit
                                    </button>
                                </form>

                                {{-- Form Hapus --}}
                                <form action="{{ route('alternatif.destroy', $alternatif->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus alternatif ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                Belum ada data alternatif.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
