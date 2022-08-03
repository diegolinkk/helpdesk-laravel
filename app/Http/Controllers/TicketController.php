<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('ticket.index',[
            'tickets' => $tickets,
        ]);
    }

    public function formCreate()
    {
        $userTeamId = Auth::user()->team->id;
        $categories = Category::where('team_id',$userTeamId)->get();
        $ticketTypes = TicketType::where('team_id',$userTeamId)->get();
        $responsibleTechs = User::where('team_id',$userTeamId)->get();

        return view('ticket.create',[
            'categories' => $categories,
            'ticketTypes' => $ticketTypes,
            'responsibleTechs' => $responsibleTechs
        ]);
    }

    public function create(Request $request)
    {

        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->description = $request->description;

        if($request->created_date)
        {
            $ticket->created_at = $request->created_date;
        }

        if($request->finished_date)
        {
            $ticket->finished_date = $request->finished_date;
            $ticket->finished = true;
        }

        $ticket->ticket_type_id = $request->type_id;
        $ticket->category_id = $request->category_id;
        $ticket->team_id = Auth::user()->team->id;
        $ticket->responsible_tech = $request->responsible_tech;
        $ticket->save();
        return $ticket;
    }

}
