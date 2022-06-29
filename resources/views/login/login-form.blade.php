@extends('template')

@section('content')
<h1>Formulário de login</h1>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif

<form action="#" method="post">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Enviar</button>
    </div>

</form>
@endsection