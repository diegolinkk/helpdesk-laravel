@extends('template')

@section('content')
    <h1>Cadastro de chamado:</h1>
    <form action="#" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" id="name" class="form-control" placeholder="nome" aria-label="nome">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <textarea type="text" name="description" id="description" class="form-control" placeholder="Descrição" aria-label="Descrição" rows="5"></textarea>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col">
                
                <select name="type_id" id="type_id" class="form-select">
                    <option selected>Tipo de chamado</option>
                    @foreach($ticketTypes as $ticketType)
                        <option value="{{$ticketType->id}}">{{$ticketType->name}}</option>
                    @endforeach
                </select>
                <a href="{{route('ticketType.store')}}" class="link-primary">Criar tipo de chamado</a>
            </div>

            <div class="col">
                <select name="category_id" id="category_id" class="form-select">

                    <option selected>Categoria</option>
                    @foreach($categories as $category)
                        {{$category->id}}
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                    @endforeach
                </select>
                <a href="#" class="link-primary">Criar categoria</a>
            </div>
            
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="created_date" class="form-label">Created Date:</label>
                <input type="date" name="created_date" id="created_date" class="form-control">
            </div>
            <div class="col">
                <label for="finished_date" class="form-label">Finished Date:</label>
                <input type="date" name="finished_date" id="finished_date" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection