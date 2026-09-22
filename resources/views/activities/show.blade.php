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
@endsection