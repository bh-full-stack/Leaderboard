@extends('layouts/app')

@section('content')
    Thanks {{ $player->name }}, your account has been activated!
    @if ($roundCount)
        <form action="sign-up/handle-old-scores" method="post">
            {{ csrf_field() }}
            Your nick already has saved scores in our database. Would you like to keep them?
            <button name="action" value="keep">Keep scores</button>
            <button name="action" value="delete">Delete scores</button>
        </form>
    @endif
@endsection