@extends('template')

@section('content')
<a href="{{route('ticket_create')}}" class="btn btn-outline-primary">Criar chamado</a>
<div class="mt-3">
    <ul>
        <li>chamado 1</li>
        <li>chamado 2</li>
        <li>chamado 3</li>
        <li>chamado 4</li>
        <li>chamado 5</li>
    </ul>
</div>
@endsection