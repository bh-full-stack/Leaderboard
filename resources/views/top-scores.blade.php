@extends('layouts/app')

@section('content')
    <h3 class="pull-left">Top Scores</h3>
    <select class="form-control pull-right" id="game-list">
        <option value="">All</option>
        @foreach ($listOfGames as $game)
            <option>{{ $game }}</option>
        @endforeach
    </select>

    <table class="table table-hover" id="top-scores">
        <thead>
        <tr>
            <th data-sort="string">Nick</th>
            <th data-sort="string">Game</th>
            <th data-sort="int">Top score</th>
            <th data-sort="int">Number of rounds</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($playersData as $playerData)
            <tr>
                <td>{{ $playerData->nick }}</td>
                <td>{{ $playerData->game }}</td>
                <td>{{ $playerData->top_score }}</td>
                <td>{{ $playerData->number_of_rounds }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection