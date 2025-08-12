<x-app-layout>
        <div class="filters">
            <form action="{{ route('index') }}" method="GET">
                <div>
                    <label for="search_by">Search by</label>
                    <select name="search_by" id="search_by" required class="basic-input">
                        <option value="" disabled {{ !request('search_by') ? 'selected' : '' }}>Select an option</option>
                        <option value="title" {{ request('search_by') == 'title' ? 'selected' : '' }}>Title</option>
                        <option value="year" {{ request('search_by') == 'year' ? 'selected' : '' }}>Year</option>
                    </select>

                    <input type="text" name="search" id="search" placeholder="Enter search term"
                        value="{{ request('search') }}" class="basic-input">
                    <button type="submit" class="btn-type2">Search <i class="fa-solid fa-magnifying-glass"></i></button>
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
                    <select name="category_id" id="category_id" onchange="this.form.submit()" class="basic-input">
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
                    <button type="submit" class="btn-type2" name="clear" value="1">Clear Filter <i
                            class="fa-solid fa-eraser"></i></button>
                </div>
            </form>
            @if (Auth()->user() && Auth()->user()->is_admin)
                <a href="{{ route('movie.create') }}" class="new-link">Add Movie</a>
            @endif
        </div>

    <main class="movie-list">
        @if ($movies->isNotEmpty())
            <div class="container-movies">
                @foreach ($movies as $movie)
                    <div class="movie-card">
                        <a href="{{ route('movie.show', ['id' => $movie->id]) }}">
                            <div>
                                <h3>{{ $movie->title }}</h3>
                                <span>{{ $movie->year }}</span>
                            </div>
                            <div class="img-div"><img src="{{ asset('storage/' . $movie->image) }}" alt="Poster de {{ $movie->title }}"></div>
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