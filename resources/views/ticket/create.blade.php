@extends('template')

@section('content')
    <h1>Cadastro de chamado:</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif

    @if(session('ticketTypeCreated'))
        <div class="alert alert-success">{{session('ticketTypeCreated')}}</div>
    @endif
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
                <label for="type_id">tipo de chamado:</label>
                <select name="type_id" id="type_id" class="form-select">
                    @foreach($ticketTypes as $index => $ticketType)
                        <option 
                        @if($index == 0)
                            selected
                        @endif
                        value="{{$ticketType->id}}">{{$ticketType->name}}</option>
                    @endforeach
                </select>
                <a href="{{route('ticketType.store')}}" class="link-primary">Criar tipo de chamado</a>
            </div>

            <div class="col">
                <label for="category_id">Categoria:</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach($categories as $index => $category)
                        <option 
                        @if($index == 0) 
                            selected 
                        @endif
                        value="{{$category->id}}"> {{$category->name}} </option>
                    @endforeach
                </select>
                <a href="{{route('category.store')}}" class="link-primary">Criar categoria</a>
            </div>

            <div class="col">
                <label for="responsible_tech" >Técnico responsável:</label>
                <select name="responsible_tech" id="responsible_tech" class="form-select">
                    @foreach($responsibleTechs as $index => $tech)
                    <option 
                    value="{{$tech->id}}">{{$tech->name}} -  ({{$tech->qtdTickets}} chamados)</option>
                    @endforeach
                </select>
            </div>
            
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="created_date" class="form-label">Data de criação:</label>
                <input type="date" name="created_date" id="created_date" class="form-control">
            </div>
            <div class="col">
                <label for="finished_date" class="form-label">Data de finalização:</label>
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