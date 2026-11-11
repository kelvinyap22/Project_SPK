
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPK TOPSIS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container">
        <a href="{{ route('topsis.index') }}"
           class="navbar-brand">
            Sistem Pendukung Keputusan Metode TOPSIS
        </a>
    </div>
</nav>

<div class="container pb-5">

    <div class="mb-4">
        <a href="{{ route('alternatif.index') }}"
           class="btn btn-outline-primary">
            Alternatif
        </a>

        <a href="{{ route('kriteria.index') }}"
           class="btn btn-outline-primary">
            Kriteria
        </a>

        <a href="{{ route('nilai.index') }}"
           class="btn btn-outline-primary">
            Input Nilai
        </a>

        <a href="{{ route('topsis.index') }}"
           class="btn btn-outline-success">
            Perhitungan TOPSIS
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>
