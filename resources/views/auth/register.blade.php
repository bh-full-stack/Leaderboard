@extends('layouts/app')

@section('content')
    <h3>Sign Up</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="sign-up-form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <label>
            Nickname:
            <input name="name" value="{{ old('name') }}" type="text" class="form-control" required>
        </label>
        <label>
            Password:
            <input name="password" type="password" class="form-control" required>
        </label>
        <label>
            Confirm password:
            <input name="password_confirmation" type="password" class="form-control" required>
        </label>
        <label>
            Email:
            <input name="email" value="{{ old('email') }}" type="email" class="form-control" required>
        </label>
        <input type="submit" class="btn">
    </form>
@endsection