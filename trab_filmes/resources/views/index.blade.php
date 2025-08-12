<x-app-layout>

    <form action="{{ route('index') }}" method="GET">
        <div>
            <label for="search_by">Search by</label>
            <select name="search_by" id="search_by" required>
                <option value="" disabled {{ !request('search_by') ? 'selected' : '' }}>Select an option</option>
                <option value="title" {{ request('search_by') == 'title' ? 'selected' : '' }}>Title</option>
                <option value="year" {{ request('search_by') == 'year' ? 'selected' : '' }}>Year</option>
            </select>

            <input type="text" name="search" id="search" placeholder="Enter search term"
                value="{{ request('search') }}">
            <button type="submit">Search <i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
    <form action="{{ route('index') }}" method="GET">
        <div>
            <label>Year order</label>
            <button class="btn-order" type="submit" name="year_order" value="asc" style="margin-right:0.5rem;">
                <i class="fa-solid fa-arrow-down-1-9"></i>
            </button>
            <button class="btn-order" type="submit" name="year_order" value="desc">
                <i class="fa-solid fa-arrow-down-9-1"></i>
            </button>
        </div>
    </form>
    <form action="{{ route('index') }}" method="GET">
        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" onchange="this.form.submit()">
                <option value="" {{ !request('category_id') ? 'selected' : '' }}>All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
    <form action="{{ route('index') }}" method="GET">
        <div>
            <button type="submit" class="btn-clear" name="clear" value="1">Clear Filter <i
                    class="fa-solid fa-eraser"></i></button>
        </div>
    </form>

    @if (Auth()->user() && Auth()->user()->is_admin)
        <a href="{{ route('movie.create') }}"><i class="fa-solid fa-plus"></i> Add Movie</a>
    @endif

    <main class="movie-list">
        @if ($movies->isNotEmpty())
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
            <p>Oops! Seems like there are no movies registered</p>
        @endif
    </main>
    @if ($alert = session('alert'))
        <script>
            showAlert(@json($alert['message']), @json($alert['type']));
        </script>
    @endif
</x-app-layout>