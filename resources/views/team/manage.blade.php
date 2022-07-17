@extends('template')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger"> {{session('error')}}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success"> {{session('success')}}</div>
    @endif
    <h1>Todos os usuários da equipe: {{$team->name}}</h1>
    <div class="mb-3">

        <a href="{{route('create_user_team')}}" class="btn btn-primary">Adicionar usuário à equipe</a><br>
    </div>
    <ul>

        @foreach($teamUsers as $user)
        <li>
        {{$user->id}} - {{$user->name}}
        <a href="{{route('user.show',$user->id)}}">editar</a>
        <a href="{{route('user.update_password',$user->id)}}">atualizar senha</a>
        
        <a href="{{route('delete_user', $user->id)}}">remover</a> 
        </li>
        @endforeach
    </ul>
@endsection