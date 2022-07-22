<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('ticket.index');
    }

    public function formCreate()
    {
        return view('ticket.create');
    }

    public function create(Request $request)
    {
        //parei aqui
         return $request->all();
    }

}
