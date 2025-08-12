<x-app-layout>
    <a href="{{ route('index') }}">Back to Movies</a>
    @if (Auth()->user() && Auth()->user()->is_admin)
        <form action="{{ route('movie.edit', ['id' => $movie->id]) }}" method="GET">
            @csrf
            <button type="submit"><i class="fa-solid fa-pen"></i> Edit Movie</button>
        </form>
        <form action="{{ route('movie.destroy', ['id' => $movie->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"><i class="fa-solid fa-trash-can"></i> Delete Movie</button>
        </form>
    @endif
    <h1>{{ $movie->title }}</h1>
    <p><strong>Year:</strong> {{ $movie->year }}</p>
    <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
    <p><strong>Category:</strong> {{ $movie->category->name }}</p>
    <img src="{{ asset('storage/' . $movie->image) }}" alt="Poster of {{ $movie->title }}"
        style="width: 100%; max-width: 400px;">
    <div style="max-width: 560px;">
        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" width="100%" height="315"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>
    </div>
    @if ($alert = session('alert'))
        <script>
            showAlert(@json($alert['message']), @json($alert['type']));
        </script>
    @endif
</x-app-layout>