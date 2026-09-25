@extends('layouts.app')

@section('content')
    <h2>Tambah Kegiatan</h2>

    <form action="{{ route('activities.store') }}" method="POST">
        @csrf

        @include('activities._form')

        <br>
        <button type="submit">Simpan</button>
    </form>

    <br>

    <a href="{{ route('activities.index') }}">
        Kembali ke Daftar Kegiatan
    </a>
@endsection