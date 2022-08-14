<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TicketTypeFormRequest;

class TicketTypeController extends Controller
{
    public function storeForm()
    {
        //return index store form
        return view('ticketType.store');
    }

    public function store(TicketTypeFormRequest $request)
    {
        $ticketType = new TicketType();
        $ticketType->name = $request->name;
        $ticketType->team_id = Auth::user()->team->id;
        $ticketType->save();
        $name = $request->name;
        return redirect()->route('ticket_create')->with('ticketTypeCreated',"Tipo de chamado: {$ticketType->name} criado com sucesso");
    }

}