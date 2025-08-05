<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list () {
        return Category::all()->sortKey('name', 'asc');
    }

    public function create () {
        if (!auth()->user()->is_admin) {
            return redirect()->route('movies.list')->with('error', "You can't create categories without being an admin");
        }
        return view('category.create');
    }

    public function store (Request $request) {
        if (!auth()->user()->is_admin) {
            return redirect()->route('movies.list')->with('error', "You can't create categories without being an admin");
        }
        
        $data = $request->validate([]);
    }
}
