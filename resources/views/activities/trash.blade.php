@extends('layouts.app')

@section('content')
    <h2>Trash Kegiatan</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @forelse ($activities as $activity)
        <article>
            <h3>[{{ $activity->code }}] {{ $activity->title }}</h3>
            <p>Kategori: {{ $activity->category->name }} | Dihapus: {{ $activity->deleted_at->format('d M Y H:i') }}</p>
            <form action="{{ route('activities.restore', $activity->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">Pulihkan</button>
            </form>
        </article>
    @empty
        <p>Trash kosong.</p>
    @endforelse

    {{ $activities->links() }}
@endsection
