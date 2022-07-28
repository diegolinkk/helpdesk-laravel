<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function storeForm()
    {
        //return index store form
        return view('ticketType.store');
    }

    public function store(Request $request)
    {
        return $request->all();
    }

}
