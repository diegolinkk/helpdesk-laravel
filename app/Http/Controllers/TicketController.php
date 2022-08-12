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
        //return only unfinished tickets
        $tickets = Ticket::where(['finished'=> false])
                ->orderBy('id','desc')
                ->get();
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
        return redirect()->route('ticket_list');
    }

    public function show($ticketId,Request $request)
    {
        $teamUserId = Auth::user()->team->id;
        $categories = Category::where('team_id',$teamUserId)->get();
        $ticketTypes = TicketType::where('team_id',$teamUserId)->get();
        $teamUsers = User::where('team_id',$teamUserId)->get();
        $ticket = Ticket::find($ticketId);

        return view('ticket.show',[
            'ticket' => $ticket,
            'categories' => $categories,
            'ticketTypes' => $ticketTypes,
            'teamUsers' => $teamUsers,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);

        
        if(!$request->finished)
        {
            $data['finished'] = false;
        }

        $ticket = Ticket::where('id',"{$request->id}")
            ->update($data);
        
        return Ticket::find($request->id);
    }

    public function finish($ticketId)
    {
        $ticket = Ticket::find($ticketId);
        $ticket->finished = true;
        $ticket->finished_date = date('Y-m-d');
        $ticket->save();
        return redirect()->route('ticket_list');
    }

}
