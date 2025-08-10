<x-app-layout>
    <nav>
        <h2>Filter</h2>
        <form action="">
            <div>
                Search
                <select name="" id="">
                    <option value="">Select an option:</option>
                    <option value="">Name</option>
                    <option value="">Especific Year</option>
                </select>
                <input type="submit" value="">
            </div>
            <div>
                Year
                <button type="submit">
                    asc
                </button>
                <button type="submit">
                    desc
                </button>
            </div>
            <div>
                Category
                <select type="submit" name="" id="">
                </select>
            </div>
        </form>
    </nav>

    @if (Auth()->user() && Auth()->user()->is_admin)
        <a href="{{ route('movie.create') }}">Add Movie</a>
    @endif

    <main class="movie-list">
        @if (!empty($movies))
            <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center;">
                @foreach ($movies as $movie)
                    <div class="movie-card"
                        style="width: 220px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 8px #eee; overflow: hidden; background: #fff;">
                        <a href="{{ route('movie.show', ['id' => $movie->id]) }}"
                            style="text-decoration: none; color: inherit; display: block;">
                            <div style="padding: 1rem 1rem 0 1rem; text-align: center; background: #f8f8f8;">
                                <h3 style="margin: 0; font-size: 1.1rem; font-weight: bold;">{{ $movie->title }}</h3>
                                <span style="color: #888; font-size: 0.95rem;">{{ $movie->year }}</span>
                            </div>
                            <img src="{{ asset('storage/' . $movie->image) }}" alt="Poster de {{ $movie->title }}"
                                style="width: 100%; height: 320px; object-fit: cover; display: block;">
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>Não há filmes cadastrados, aguarde novidades!</p>
        @endif
    </main>
</x-app-layout>