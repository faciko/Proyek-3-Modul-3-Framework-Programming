@extends('layouts.app')

@section('content')
    <h2>Daftar Kegiatan</h2>

    @forelse ($activities as $activity)
        <article>
            <h3>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h3>

            <p>Tanggal: {{ $activity->activity_date->format('d M Y') }}</p>
            <p>Status: {{ $activity->status }}</p>
        </article>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
@endsection