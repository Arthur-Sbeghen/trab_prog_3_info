<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function list()
    {
        $data = Movie::all(['title', 'id', 'year', 'image']);

        return view('index', ['movies' => $data]);
    }

    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return redirect()->route('index')->with('error', 'Movie not found');
        }


        return view('movie.show', compact('movie'));
    }

    public function create()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't create movies without being an admin");
        }

        $categories = Category::all()->sortBy('name');

        return view('movie.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't create movies without being an admin");
        }

        // Validação dos campos, incluindo imagem
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'categories' => 'required|exists:categories,id',
            'synopsis' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'trailer_link' => 'required|url',
        ]);

        $imagePath = null;
        if ($request->hasFile('poster')) {
            $imagePath = $request->file('poster')->store('posters', 'public');
        }

        try {
            Movie::create([
                'title' => $data['title'],
                'year' => $data['year'],
                'category_id' => $data['categories'],
                'synopsis' => $data['synopsis'],
                'image' => $imagePath,
                'trailer_link' => $data['trailer_link'],
            ]);
        } catch (Exception $error) {
            return redirect()->route('movie.create')->with('error', 'Failed to create movie: ' . $error->getMessage());
        }

        return redirect()->route('index')->with('success', "Movie '" . $data['title'] . "' created successfully!");
    }

    public function edit($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't edit movies without being an admin");
        }

        $movie = Movie::find($id);

        if (!$movie) {
            return redirect()->route('index')->with('error', 'Movie not found');
        }

        return view('movie.edit', ['movie' => $movie]);
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't edit movies without being an admin");
        }

        // inserir validações
        $data = $request->validate([]);

        try {
            $movie = Movie::find($id);
            if (!$movie) {
                return redirect()->route('index')->with('error', 'Movie not found');
            }
            $movie->update($data);
        } catch (Exception $error) {
            return redirect()->route('movie.edit', ['id' => $id])->with('error', 'Failed to update movie: ' . $error->getMessage());
        }

        return redirect()->route('index')->with('success', "Movie '" . $data['name'] . "' updated successfully");
    }

    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't delete movies without being an admin");
        }

        $movie = Movie::find($id);

        if (!$movie) {
            return redirect()->route('index')->with('error', 'Movie not found');
        }

        try {
            $movie->delete();
        } catch (Exception $error) {
            return redirect()->route('index')->with('error', 'Failed to delete movie: ' . $error->getMessage());
        }

        return redirect()->route('index')->with('success', "Movie '" . $movie['name'] . "' deleted successfully");
    }
}
