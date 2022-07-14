<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Team};

class ManageTeamController extends Controller
{
    public function index(Request $request)
    {
        $teamId = $request->user()->team->id;
        $team = Team::find($teamId);

        $teamUsers = User::where('team_id',$teamId)
            ->orderBy('name')
            ->get();
            
        return view('team.manage',[
            'teamUsers' => $teamUsers,
            'team' => $team
        ]);
    }

    public function createTeamUserForm()
    {
        return view('team.create-user');
    }

}
