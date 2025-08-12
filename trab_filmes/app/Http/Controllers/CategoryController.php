<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $data = Category::all()->sortBy('name');

        return view('category.list', ['categories' => $data]);
    }

    public function create()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't create categories without being an admin");
        }
        return view('category.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't create categories without being an admin");
        }
        
        $data = $request->validate([
            'name' => 'string|max:255',
        ]);

        Category::create([
            'name' => $data['name'],
        ]);

        return redirect()->route('category.list')->with('success', "Category '" . $data['name'] . "' created successfully");
    }

    public function edit($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('category.list')->with('error', "You can't edit categories without being an admin");
        }

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category.list')->with('error', 'Category not found');
        }

        return view('category.edit', compact('category'));
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('category.list')->with('error', "You can't edit categories without being an admin");
        }

        $data = $request->validate([
            'name' => 'string|max:255',
        ]);

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.list')->with('error', 'Category not found');
        }
        if ($request->has('name')) {
            $category->name = $request->input('name');
        }
        
        $category->save();


        return redirect()->route('category.list')->with('success', "Category '" . $data['name'] . "' updated successfully");
    }

    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('category.list')->with('error', "You can't delete categories without being an admin");
        }

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category.list')->with('error', 'Category not found');
        }

        try {
            $category->delete();
        } catch (Exception $error) {
            return redirect()->route('category.list')->with('error', 'Failed to delete category: ' . $error->getMessage());
        }

        return redirect()->route('category.list')->with('success', "Category '" . $category['name'] . "' deleted successfully");
    }
}