@extends('template')

@section('content')
    <h1>Edição de chamado:</h1>
    <form action="#" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$ticket->id}}">

        <div class="row">

            <div class="col-11">                
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$ticket->name}}">
            </div>

            <div class="col d-flex align-items-center">
                <label for="finished" class="form-check-label">Finalizado</label>
                <input class="form-check-input" type="checkbox" name="finished" id="finished"
                @if($ticket->finished)
                    checked
                @endif>
            </div>

        </div>

        <div class="mb-3 row">
            <div class="col">
                <label for="created_at" class="form-label">Data de criação:</label>
                <input class="form-control" type="date" name="created_at" id="created_at" value="{{date('Y-m-d',strtotime($ticket->created_at))}}">
            </div>
            <div class="col">
                <label for="finished_date" class="form-label">Data de finalização:</label>
                <input class="form-control" type="date" name="finished_date" id="finished_date" 
                @if($ticket->finished_date) value="{{date('Y-m-d', strtotime($ticket->finished_date))}}" @endif >
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="category_id">Categoria:</label>
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach($categories as $category)
                        <option
                        @if($category->id == $ticket->category->id)
                            selected
                        @endif
                        value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label for="ticket_type_id">Tipo:</label>
                    <select name="ticket_type_id" id="ticket_type_id" class="form-select">
                        @foreach($ticketTypes as $type)
                        <option
                        @if($type->id == $ticket->ticketType->id)
                            selected
                        @endif
                        value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label for="responsible_tech">Tipo:</label>
                    <select name="responsible_tech" id="responsible_tech" class="form-select">
                        @foreach($teamUsers as $user)
                        <option
                        @if($ticket->responsibleTech)
                            @if($user->id == $ticket->responsibleTech->id)
                                selected
                            @endif
                        @endif
                        value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
   
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{$ticket->description}}</textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{route('ticket.finish',$ticket->id)}}" class="btn btn-secondary">Finalizar chamado</a>
            </div>

        </div>
    </form>
@endsection