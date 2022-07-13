<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $teamData = ['name' => $request->name];
        $team = Team::create($teamData);
        
        $data = $request->except('_token');
        $data['team_id'] = $team->id;
        $data['is_admin'] = true;
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('login')->with("userCreatedMessage","Usuário criado com sucesso");
    }
}
