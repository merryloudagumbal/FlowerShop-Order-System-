@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Create an account</h1>
        <p>Register for the flower shop order system.</p>
    </div>

    <div class="card" style="max-width: 560px; margin: 0 auto; padding: 28px;">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="field">
                <label for="name">Full name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

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

            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Register</button>
        </form>
    </div>
@endsection
