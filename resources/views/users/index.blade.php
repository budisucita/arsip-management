@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Manajemen Pengguna</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User
            @if(auth()->user()->role !== 'admin') style="display: none" @endif>
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $user)
            <tr>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection