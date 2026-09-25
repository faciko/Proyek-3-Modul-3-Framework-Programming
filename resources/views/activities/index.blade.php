@extends('layouts.app')

@section('content')
    <form action="{{ route('activities.index') }}" method="GET">
        <label for="status">Filter Status</label>

        <select id="status" name="status">
            <option value="">Semua</option>

            <option value="Planned"
                @selected($status === 'Planned')>
                Planned
            </option>

            <option value="Ongoing"
                @selected($status === 'Ongoing')>
                Ongoing
            </option>

            <option value="Done"
                @selected($status === 'Done')>
                Done
            </option>
        </select>

        <button type="submit">Filter</button>
    </form>
    
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