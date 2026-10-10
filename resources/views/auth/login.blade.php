@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Welcome back</h1>
        <p>Sign in to access the flower shop dashboard.</p>
    </div>

    <div class="card" style="max-width: 520px; margin: 0 auto; padding: 28px;">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field" style="display:flex; flex-direction:row; align-items:center; gap:10px; margin-bottom:22px;">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style="margin:0;">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>
        </form>
    </div>
@endsection
