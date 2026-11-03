{{-- 'nama', 'nim', 'email', 'nomor_telepon', 'alamat', 'status' --}}

@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')

<h1>Tambah Anggota</h1>
<p><a href="{{ route('members.index') }}">&larr; Kembali ke Daftar Anggota</a></p>

<form action="{{ route('members.store') }}" method="post">
    @csrf
    <label for="nama">Nama Anggota</label>
    <input type="text" name="nama" id="nama" value="{{ old('nama') }}">
        @error('nama')
            <div class="error">{{ $message }}</div>
        @enderror
    <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim" value="{{ old('nim') }}">
            @error('nim')
                <div class="error">{{ $message }}</div>
            @enderror
    <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
    <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}">
            @error('nomor_telepon')
                <div class="error">{{ $message }}</div>
            @enderror
    <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}">
            @error('alamat')
                <div class="error">{{ $message }}</div>
            @enderror
    <label for="status">Status</label>
            <select name="status" id="status">
                <option value="">-- Status --</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn">Simpan</button>
</form>

@endsection
