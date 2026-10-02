@extends('layouts.app')

@section('content')
    <h2>Edit Kegiatan</h2>

    <form action="{{ route('activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('activities._form')

        <br>
        <button type="submit">Update</button>
    </form>

    <br>

    <a href="{{ route('activities.show', $activity) }}">
        Kembali ke Detail
    </a>
@endsection
