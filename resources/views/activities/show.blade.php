@extends('layouts.app')

@section('content')
    <h2>Detail Kegiatan</h2>

    <article>
        <h3>{{ $activity->title }}</h3>

        <p>Deskripsi: {{ $activity->description }}</p>

        <p>
            Tanggal:
            {{ $activity->activity_date->format('d M Y') }}
        </p>

        <p>Kategori: {{ $activity->category }}</p>

        <p>Status: {{ $activity->status }}</p>
    </article>

    <a href="{{ route('activities.index') }}">
        Kembali ke Daftar Kegiatan
    </a>

    <form
        action="{{ route('activities.destroy', $activity) }}"
        method="POST"
    >
        @csrf
        @method('DELETE')

        <button type="submit">Hapus</button>
    </form>
@endsection