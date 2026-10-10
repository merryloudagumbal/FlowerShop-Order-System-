@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Create User</h1>
        <p>Create a new user account and assign a role.</p>
    </div>

    <div class="card" style="max-width:600px; margin:0 auto; padding:24px;">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="field">
                <label for="name">Full name</label>
                <input id="name" name="name" value="{{ old('name') }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <div class="field">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="customer">Customer</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
                @error('role')<div class="error">{{ $message }}</div>@enderror
            </div>

            <button class="btn btn-primary" type="submit">Create user</button>
        </form>
    </div>
@endsection
