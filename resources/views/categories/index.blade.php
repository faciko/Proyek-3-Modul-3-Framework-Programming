@extends('layouts.app')

@section('content')
    <h2>Manajemen Kategori</h2>

    @if (session('success'))
        <div style="color: green; margin-bottom: 1em;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red; margin-bottom: 1em;">
            {{ session('error') }}
        </div>
    @endif

    <h3>Tambah Kategori Baru</h3>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nama Kategori</label>
            <input type="text" id="name" name="name" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
            <button type="submit">Simpan</button>
        </div>
    </form>

    <br>
    <h3>Daftar Kategori</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Jumlah Kegiatan Terkait</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->slug }}</td>
                    <td>{{ $cat->activities_count }} kegiatan</td>
                    <td>
                        <form action="{{ route('categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <a href="{{ route('activities.index') }}">Kembali ke Daftar Kegiatan</a>
@endsection
