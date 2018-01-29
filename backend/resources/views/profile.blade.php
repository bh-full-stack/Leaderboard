@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h1>Welcome, {{ $player->name }} </h1>
        @if (!empty($message))
            <div class="alert alert-info">{{ $message }}</div>
        @endif
        @if ($player->has_deletable_rounds)
        <p>
            Your account already has saved scores in our database.<br>
            Would you like to keep them?
        </p>
        <form method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>
                <div>
                    <input id="password" type="password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <button name="old-scores-action" value="delete">Delete</button>
            <button name="old-scores-action" value="keep">Keep</button>
        </form>
        @endif
    </div>
</div>
@endsection