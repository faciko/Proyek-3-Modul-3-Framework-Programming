@extends('layouts.app')

@section('content')
    <h2>Detail Kegiatan</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <article>
        <h3>[{{ $activity->code }}] {{ $activity->title }}</h3>
        @if ($activity->poster_path)
            <img src="{{ Storage::url($activity->poster_path) }}" alt="Poster {{ $activity->title }}" width="240">
        @endif
        <p><strong>Kategori:</strong> {{ $activity->category->name }}</p>
        <p><strong>Status:</strong> {{ $activity->status }}</p>
        <p><strong>Lokasi:</strong> {{ $activity->location }}</p>
        <p><strong>Waktu:</strong> {{ $activity->start_at->format('d M Y H:i') }} - {{ $activity->end_at->format('d M Y H:i') }}</p>
        <p><strong>Kapasitas:</strong> {{ $activity->registered_count }}/{{ $activity->capacity }}</p>
        <p>{{ $activity->description }}</p>
    </article>

    @if ($activity->status === 'draft')
        <form action="{{ route('activities.publish', $activity) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit">Publish</button>
        </form>
    @elseif ($activity->status === 'published')
        <form action="{{ route('activities.complete', $activity) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit">Tandai Selesai</button>
        </form>

        <h3>Daftar Peserta</h3>
        @error('registration')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <form action="{{ route('activities.registrations.store', $activity) }}" method="POST">
            @csrf
            <label for="participant_name">Nama</label>
            <input id="participant_name" name="participant_name" value="{{ old('participant_name') }}" required>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            <button type="submit">Daftar</button>
        </form>
    @endif

    <p>
        <a href="{{ route('activities.index') }}">Kembali</a>
        <a href="{{ route('activities.edit', $activity) }}">Edit</a>
    </p>
    <form action="{{ route('activities.destroy', $activity) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus ke Trash</button>
    </form>
@endsection
