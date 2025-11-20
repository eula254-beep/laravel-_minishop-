@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    <h2 style="text-align: center; margin-bottom: 20px;">Login</h2>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 3px;">
            @foreach ($errors->all() as $error)
                <p style="margin: 0;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
                style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px;">Password:</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required
                style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: flex; align-items: center;">
                <input type="checkbox" name="remember" style="margin-right: 5px;">
                Remember Me
            </label>
        </div>

        <button 
            type="submit" 
            style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 16px;"
        >
            Login
        </button>

        <p style="text-align: center; margin-top: 15px;">
            Don't have an account? <a href="{{ route('register') }}" style="color: #007bff;">Register here</a>
        </p>
    </form>
</div>
@endsection
