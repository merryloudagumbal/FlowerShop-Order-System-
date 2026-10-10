@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Users</h1>
        <p>All user accounts.</p>
    </div>

    @if (session('success'))
        <div class="alert success" style="margin-bottom:16px;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert error" style="margin-bottom:16px;">{{ session('error') }}</div>
    @endif

    <div style="margin-bottom:16px;">
        <a class="btn" href="{{ route('admin.users.create') }}">Create User</a>
    </div>

    <div class="card" style="padding:16px;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a class="btn btn-small" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline; margin-left:8px;" onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-small">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
