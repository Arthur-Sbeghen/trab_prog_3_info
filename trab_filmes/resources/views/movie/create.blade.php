<x-app-layout>
    <h1>Add Movie</h1>
    <a href="{{ route('index') }}">Back</a>
    <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <label for="title">Title</label>
    <input type="text" name="title" id="title" required>

    <label for="year">Year</label>
    <input type="number" name="year" id="year" required>

    <label for="categories">Category</label>
    <select name="categories" id="categories" required>
        <!-- Adicione as opções dinamicamente no backend -->
        <option value="action">Action</option>
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
    </select>

    <label for="synopsis">Synopsis</label>
    <textarea name="synopsis" id="synopsis" required></textarea>

    <label for="poster">Poster</label>
    <input type="file" accept="image/*" name="poster" id="poster" required>
    <img id="posterPreview" style="max-width: 200px; margin-top: 10px; display: none; border: 1px solid #ccc;" />

    <label for="url">YouTube Trailer</label>
    <input type="url" name="trailer_link" id="url" placeholder="https://www.youtube.com/watch?v=..." required>
    <div id="youtubePreview" style="margin-top: 10px;">
        <!-- iframe será inserido aqui -->
    </div>

    <button type="submit">Send</button>
</form>

<script>
    // Pré-visualização do poster (imagem)
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
        console.log(match);
        return (match && match[2].length === 11) ? match[2] : null;
    }
</script>
</x-app-layout>