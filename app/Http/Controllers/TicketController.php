<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        return view('ticket.index');
    }

    public function formCreate()
    {
        $categories = Category::all();
        $ticketTypes = TicketType::all();
        return view('ticket.create',[
            'categories' => $categories,
            'ticketTypes' => $ticketTypes,
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
        }

        $ticket->ticket_type_id = $request->type_id;
        $ticket->category_id = $request->category_id;
        $ticket->team_id = Auth::user()->team->id;
        $ticket->save();
        return $ticket;
    }

}
