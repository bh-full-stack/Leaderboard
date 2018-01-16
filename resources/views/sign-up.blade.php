@extends('layouts/app')

@section('content')
<h3>Sign Up</h3>

<form class="sign-up-form" method="POST">
    <label>
        Nickname:
        <input name="nick" type="text" class="form-control">
    </label>
    <label>
        Password:
        <input name="password" type="password" class="form-control">
    </label>
    <label>
        Email:
        <input name="email" type="email" class="form-control">
    </label>
    <input type="submit" class="btn">
</form>
@endsection