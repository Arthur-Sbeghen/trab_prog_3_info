<x-app-layout>
    <a href="{{ route('index') }}">Back to Movies</a>
    <h1>{{ $movie->title }}</h1>
    <p><strong>Year:</strong> {{ $movie->year }}</p>
    <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
    <p><strong>Category:</strong> {{ $movie->category->name }}</p>
    <img src="{{ asset('storage/' . $movie->image) }}" alt="Poster of {{ $movie->title }}"
        style="width: 100%; max-width: 400px;">
    @php
        function extractYoutubeID($url)
        {
            $pattern = '/(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11})/';
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
            return null;
        }
        $videoId = extractYoutubeID($movie->trailer_link);
    @endphp

    @if($videoId)
        <div style="max-width: 560px;">
            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" width="100%" height="315"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
        </div>
    @endif
</x-app-layout>