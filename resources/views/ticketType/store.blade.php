@extends('template')

@section('content')
    <div class="container-md">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="#" method="post">
            @csrf
            <h1>Cadastro para Tipo de Chamado</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
    </div>
@endsection