@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Edit User</h1>
        <p>Update the selected user account and role.</p>
    </div>

    <div class="card" style="max-width:600px; margin:0 auto; padding:24px;">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="name">Full name</label>
                <input id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div style="display:flex; gap:12px; align-items:center;">
                <button class="btn btn-primary" type="submit">Update user</button>
                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
