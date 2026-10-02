@extends('layouts.app')

@section('content')
    <h2>Daftar Kegiatan</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('activities.index') }}" method="GET">
        <label for="search">Cari kode atau judul</label>
        <input id="search" name="search" value="{{ $filters['search'] ?? '' }}">

        <label for="category_id">Kategori</label>
        <select id="category_id" name="category_id">
            <option value="">Semua</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? null) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="">Semua</option>
            @foreach (['draft', 'published', 'completed'] as $status)
                <option value="{{ $status }}" @selected(($filters['status'] ?? null) === $status)>{{ $status }}</option>
            @endforeach
        </select>

        <label for="sort">Urutan</label>
        <select id="sort" name="sort">
            <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Terbaru</option>
            <option value="oldest" @selected(($filters['sort'] ?? null) === 'oldest')>Terlama</option>
        </select>
        <button type="submit">Terapkan</button>
        <a href="{{ route('activities.index') }}">Reset</a>
    </form>

    <p><a href="{{ route('activities.create') }}">Tambah kegiatan</a> | <a href="{{ route('activities.trash') }}">Lihat Trash</a></p>

    @forelse ($activities as $activity)
        <article>
            <h3><a href="{{ route('activities.show', $activity) }}">[{{ $activity->code }}] {{ $activity->title }}</a></h3>
            <p>Kategori: {{ $activity->category->name }} | Status: {{ $activity->status }}</p>
            <p>Mulai: {{ $activity->start_at->format('d M Y H:i') }} | Kapasitas: {{ $activity->registered_count }}/{{ $activity->capacity }}</p>
        </article>
    @empty
        <p>Tidak ada kegiatan yang sesuai.</p>
    @endforelse

    {{ $activities->links() }}
@endsection
