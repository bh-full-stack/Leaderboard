@extends('layouts/app')

@section('content')
<h3>Sign In</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="sign-in-form" method="POST">
    {{ csrf_field() }}
    <label>
        Nickname or email:
        <input name="nick-or-email" value="{{ old('nick-or-email') }}" type="text" class="form-control">
    </label>
    <label>
        Password:
        <input name="password" type="password" class="form-control">
    </label>
    <input type="submit" class="btn">
</form>
@endsection