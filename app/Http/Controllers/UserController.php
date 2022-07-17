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

    public function createTeamUser(Request $request)
    {
        //create team user - not admin
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = false;
        $user->team_id = Auth::user()->team_id;

        $user->save();
        return redirect()->route('manage_team')->with('success','Usuário criado com sucesso');
    }

    public function destroy($userId, Request $request)
    {
        $user = User::find($userId);

        //admin users can't be deleted
        if($user->is_admin)
        {
            return redirect()->back()->with('error','Usuário administrador não pode ser removido - remova a função de administrador antes de deletar');
        }

        $user->delete();
        return redirect()->back()->with('success','Usuário removido com sucesso');
    }

    public function show($userId)
    {
        $user = User::find($userId);
        return view('user.show',['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('manage_team');
    }

    public function updatePasswordForm($userId, Request $request)
    {
        $user = User::find($userId);
        return view('user.update-password',[
            'user' => $user,
        ]);
    }

    public function updatePassword($userId,Request $request)
    {
        $user = User::find($userId);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('manage_team');
    }
}



