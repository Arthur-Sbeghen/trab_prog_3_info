<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function list(Request $request)
    {

        if ($request->has('clear')) {
            return redirect()->route('index');
        }

        $query = Movie::query();

        if ($request->filled('search') && in_array($request->input('search_by'), ['title', 'year'])) {
            if ($request->input('search_by') === 'year') {
                $query->where('year', $request->input('search'));
            } else {
                $query->where('title', 'like', '%' . $request->input('search') . '%');
            }
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('year_order') && in_array($request->input('year_order'), ['asc', 'desc'])) {
            $query->orderBy('year', $request->input('year_order'));
        } else {
            $query->orderBy('title', 'asc');
        }

        $movies = $query->select('title', 'id', 'year', 'image')->get();

        $categories = Category::all()->sortBy('name');

        return view('index', compact('movies', 'categories'));
    }


    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return redirect()->route('index')->with('error', 'Movie not found');
        }

        $videoId = Movie::getIdFromUrl($movie->trailer_link);

        return view('movie.show', compact('movie', 'videoId'));
    }

    public function create()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't create movies without being an admin");
        }

        $categories = Category::all()->sortBy('name');

        return view('movie.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't create movies without being an admin");
        }

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

        $categories = Category::all()->sortBy('name');

        return view('movie.edit', compact('movie', 'categories'));
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('index')->with('error', "You can't edit movies without being an admin");
        }

        $data = $request->validate([
            'title' => 'string|max:255',
            'year' => 'integer',
            'categories' => 'exists:categories,id',
            'synopsis' => 'string',
            'poster' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'trailer_link' => 'url',
        ]);

        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->route('index')->with('error', 'Movie not found');
        }
        if ($request->has('title')) {
            $movie->title = $request->input('title');
        }
        if ($request->has('year')) {
            $movie->year = $request->input('year');
        }
        if ($request->has('categories')) {
            $movie->category_id = $request->input('categories');
        }
        if ($request->has('synopsis')) {
            $movie->synopsis = $request->input('synopsis');
        }
        if ($request->hasFile('poster')) {
            $movie->image = $request->file('poster')->store('posters', 'public');
        }
        if ($request->has('trailer_link')) {
            $movie->trailer_link = $request->input('trailer_link');
        }
        $movie->save();


        return redirect()->route('index')->with('success', "Movie '" . $data['title'] . "' updated successfully");
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