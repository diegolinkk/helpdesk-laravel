@extends('template')

@section('content')
    <div class="container-fluid">
        <h1>Cadastro de usuário para a equipe:</h1>

        <form action="#" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome: </label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail: </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha: </label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
    </div>
@endsection