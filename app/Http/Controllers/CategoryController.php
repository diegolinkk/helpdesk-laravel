<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function storeForm()
    {
        return view('category.store');
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->team_id = Auth::user()->team->id;
        $category->save();

        return redirect()->route('ticket_create');
    }
}
