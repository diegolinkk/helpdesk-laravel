@extends('template')

@section('content')
<a href="{{route('ticket_create')}}" class="btn btn-outline-primary">Criar chamado</a>
<h1>Lista de chamados:</h1>
<div class="mt-3">
    <div class="list-group container-fluid">
        @foreach($tickets as $ticket)
        <a href="#" class="list-group-item list-group-item-action mb-3">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$ticket->name}}</h5>
                <small>{{$ticket->created_at}}</small>
            </div>
            <p class="mb-1">{{$ticket->description}}</p>
            <small class="badge text-bg-primary">{{$ticket->ticketType->name}}</small>
            <small class="badge text-bg-secondary">{{$ticket->category->name}}</small>
            </a>

        @endforeach
    </div>
</div>
@endsection