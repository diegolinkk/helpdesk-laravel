@extends('template')

@section('content')
    <h1>Edição de usuário</h1>
    <div class="container-fluid">
        <form action="#" method="post">
            @csrf
            <input type="hidden" name="id" value={{$user->id}}>
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Nome:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" >
            </div>

            <input type="submit" value="Enviar" class="btn btn-primary">

        </form>
    </div>
@endsection