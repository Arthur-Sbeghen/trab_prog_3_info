<x-app-layout>
    <div class="options">
        <a href="{{ route('movie.show', ['id' => $movie->id]) }}" class="btn-type2"><i class="fa-solid fa-arrow-left"></i> Back to Movie</a>
    </div>
    <h1>Editing Movie {{ $movie->title }}</h1>
    
    <form action="{{ route('movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="form-edit">
        @csrf
        @method('PUT')

        <div class="input-div">
            <label for="title" class="basic-label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" class="basic-input"
                required>
        </div>

        <div class="input-div">
            <label for="year" class="basic-label">Year</label>
            <input type="number" name="year" id="year" value="{{ old('year', $movie->year) }}" class="basic-input"
                required>
        </div>

        <div class="input-div">
            <label for="categories" class="basic-label">Category</label>
            <select name="categories" id="categories" class="basic-input" required>
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('categories', $movie->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-div">
            <label for="synopsis" class="basic-label">Synopsis</label>
            <textarea name="synopsis" id="synopsis" class="basic-input"
                required>{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>

        <div class="input-div">
            <label for="poster" class="basic-label">Poster</label>
            <img src="{{ asset('storage/' . $movie->image) }}" alt="Old Image" style="max-width: 200px;   margin-top: 1rem; display: none; border: 1px solid #ccc; align-self: center;">
            <input type="file" accept="image/*" name="poster" id="poster" value="{{ old('poster') }}"
                class="basic-input">
            <img id="posterPreview"
                style="max-width: 200px; margin-top: 1rem; display: none; border: 1px solid #ccc; align-self: center;" />
        </div>

        <div class="input-div">
            <label for="url" class="basic-label">YouTube Trailer</label>
            <input type="url" name="trailer_link" id="url" placeholder="https://www.youtube.com/watch?v=..."
                value="{{ old('trailer_link', $movie->trailer_link) }}" class="basic-input">
            <div id="youtubePreview" style="margin-top: 1rem; align-self: center;"></div>
        </div>

        <button type="submit">Save Changes</button>
    </form>

    <script>
        const posterInput = document.getElementById('poster');
        const posterPreview = document.getElementById('posterPreview');

        posterInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function () {
                    posterPreview.src = reader.result;
                    posterPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        const youtubeInput = document.getElementById('url');
        const youtubePreview = document.getElementById('youtubePreview');

        youtubeInput.addEventListener('input', function () {
            const url = this.value;
            const videoId = extractYoutubeID(url);
            if (videoId) {
                youtubePreview.innerHTML = `
                <iframe 
                    src="https://www.youtube.com/embed/${videoId}" 
                    width="300" 
                    height="169" 
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>`;
            } else {
                youtubePreview.innerHTML = '';
            }
        });

        function extractYoutubeID(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11}).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }
        @if ($alert = session('alert'))
            showAlert(@json($alert['message']), @json($alert['type']));
        @endif
    </script>
</x-app-layout>