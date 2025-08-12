<?php

namespace App\Http\Controllers;

use Exception;
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
            return redirect()->route('index')->with('alert', ["type" => "error", "message" => "You can't create categories without being an admin"]);
        }
        return view('category.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('alert', ["type" => "error", "message" => "You can't create categories without being an admin"]);
        }

        $data = $request->validate([
            'name' => 'string|max:255',
        ]);

        if (Category::where('name', $data['name'])->exists()) {
            return redirect()->route('category.create')->with('alert', ["type" => "error", "message" => "Category '" . $data['name'] . "' already exists"]);
        }

        try {
            Category::create([
                'name' => $data['name'],
            ]);
        } catch (Exception $error) {
            return redirect()->route('category.create')->with('alert', ["type" => "error", "message" => 'Failed to create category: ' . $error->getMessage()]);
        }

        return redirect()->route('category.list')->with('alert', ["type" => "success", "message" => "Category '" . $data['name'] . "' created successfully"]);
    }

    public function edit($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('category.list')->with('alert', ["type" => "error", "message" => "You can't edit categories without being an admin"]);
        }

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category.list')->with('alert', ["type" => "error", "message" => 'Category not found']);
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
            return redirect()->route('category.list')->with('alert', ["type" => "error", "message" => 'Category not found']);
        }

        if ($category->name == $request->input('name')) {
            return redirect()->route('category.edit', ['id' => $id])->with('alert', ["type" => "error", "message" => "The new name can't be the same as the old one"]);
        }

        if (Category::where('name', $data['name'])->exists()) {
            return redirect()->route('category.edit', ['id' => $id])->with('alert', ["type" => "error", "message" => "Category '" . $data['name'] . "' already exists"]);
        }

        try {
            $category->name = $request->input('name');
            $category->save();
        } catch (Exception $error) {
            return redirect()->route('category.edit', ['id' => $id])->with('alert', ["type" => "error", "message" => 'Failed to update category: ' . $error->getMessage()]);
        }

        return redirect()->route('category.list')->with('alert', ["type" => "success", "message" => "Category '" . $data['name'] . "' updated successfully"]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('category.list')->with('alert', ["type" => "error", "message" => "You can't delete categories without being an admin"]);
        }

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category.list')->with('alert', ["type" => "error", "message" => 'Category not found']);
        }

        try {
            $category->delete();
        } catch (Exception $error) {
            return redirect()->route('category.list')->with('alert', ["type" => "error", "message" => 'Failed to delete category: ' . $error->getMessage()]);
        }

        return redirect()->route('category.list')->with('alert', ["type" => "success", "message" => "Category deleted successfully"]);
    }
}