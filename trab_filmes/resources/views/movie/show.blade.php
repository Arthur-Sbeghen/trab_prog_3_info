<x-app-layout>
    <div class="movie-options">   
        <a href="{{ route('index') }}" title="Back to Movies Catalog"><i class="fa-solid fa-arrow-left"></i></a>
        @if (Auth()->user() && Auth()->user()->is_admin)
            <div class="admin-movie-options">
                    <form action="{{ route('movie.edit', ['id' => $movie->id]) }}" method="GET">
                        @csrf
                        <button type="submit"><i class="fa-solid fa-pen"></i> Edit Movie</button>
                    </form>
                    <form action="{{ route('movie.destroy', ['id' => $movie->id]) }}" method="POST" onsubmit="{ return showConfirm(event, '{{ $movie->title }}', 'movie') }">
                        @csrf
                        @method('DELETE')
                        <button type="submit"><i class="fa-solid fa-trash-can"></i> Delete Movie</button>
                    </form>
            </div>
        @endif
    </div>
    <h1>{{ $movie->title }}</h1>
    <div class="movie-content">
        <img src="{{ asset('storage/' . $movie->image) }}" alt="Poster of {{ $movie->title }}" class="poster-img">
        <div class="movie-info">
            <p><strong>Year:</strong> {{ $movie->year }}</p>  
            <p><strong>Duration:</strong> {{ $movie->duration }}</p>
            <p><strong>Category:</strong> {{ $movie->category->name }}</p>
            <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
            <p><strong>Trailer</strong></p>
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" height="410rem" width="100%"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
    @if ($alert = session('alert'))
        <script>
            showAlert(@json($alert['message']), @json($alert['type']));
        </script>
    @endif
</x-app-layout>