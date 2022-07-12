@extends('template')

@section('content')
    <a href="teste" class="btn btn-outline-primary">Criar nova equipe</a>
    <h1>Lista de equipes</h1>
    <ul>
        @foreach($teams as $team)
        <li>{{$team->id}} - {{$team->name}} </li>
        @endforeach
    </ul>
@endsection()