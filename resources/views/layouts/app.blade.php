<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Activity Manager</title>
</head>
<body>

    <header>
        <h1>Activity Manager</h1>
        <nav style="margin-bottom: 1em; display: flex; gap: 15px;">
            <a href="{{ route('activities.index') }}">Daftar Kegiatan</a>
            <a href="{{ route('activities.create') }}">Tambah Kegiatan</a>
            <a href="{{ route('categories.index') }}">Kelola Kategori</a>
            <a href="{{ route('activities.trash') }}">Trash</a>
        </nav>
        <hr>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
