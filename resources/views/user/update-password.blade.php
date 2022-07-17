@extends('template')
@section('content')
<div class="container-fluid">
        <h2>Atualização de senha do usuário:</h2>
        <h4> {{$user->name}}</h4>
        <form action="#" method="post">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
    </div>
@endsection