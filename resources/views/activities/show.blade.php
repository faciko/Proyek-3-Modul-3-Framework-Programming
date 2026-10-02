@extends('layouts.app')

@section('content')
    <h2>Detail Kegiatan</h2>

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

    <article>
        <h3>[{{ $activity->code }}] {{ $activity->title }}</h3>

        <p><strong>Kategori:</strong> {{ $activity->category?->name ?? '-' }}</p>
        <p><strong>Status:</strong> <span>{{ strtoupper($activity->status) }}</span></p>
        <p><strong>Lokasi:</strong> {{ $activity->location ?? '-' }}</p>
        <p><strong>Waktu Mulai:</strong> {{ $activity->start_at ? $activity->start_at->format('d M Y H:i') : '-' }}</p>
        <p><strong>Waktu Selesai:</strong> {{ $activity->end_at ? $activity->end_at->format('d M Y H:i') : '-' }}</p>
        <p><strong>Kapasitas:</strong> {{ $activity->capacity }}</p>
        <p><strong>Deskripsi:</strong> {{ $activity->description ?? '-' }}</p>
    </article>

    <div style="margin-top: 1.5em; display: flex; gap: 10px; align-items: center;">
        <a href="{{ route('activities.index') }}">Kembali ke Daftar Kegiatan</a>
        <a href="{{ route('activities.edit', $activity) }}">Edit Kegiatan</a>

        <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus Kegiatan</button>
        </form>
    </div>
@endsection