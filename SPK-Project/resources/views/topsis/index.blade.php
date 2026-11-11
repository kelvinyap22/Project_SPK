
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Perhitungan TOPSIS</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <p>
                Klik tombol berikut untuk menghitung hasil
                perangkingan menggunakan metode TOPSIS.
            </p>

            <form action="{{ route('topsis.hitung') }}" method="POST">
                @csrf

                <button class="btn btn-primary">
                    Hitung TOPSIS
                </button>
            </form>

        </div>
    </div>

</div>

@endsection
