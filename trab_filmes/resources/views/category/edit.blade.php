<x-app-layout>
    <h1>Editing Category {{ $category->name }}</h1>
    <a href="{{ route('category.list') }}">Back</a>
    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="input-div">
            <label for="name" class="basic-label">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="basic-input"
                required>
        </div>

        <button type="submit">Save Changes</button>
    </form>
    @if ($alert = session('alert'))
        <script>
            showAlert(@json($alert['message']), @json($alert['type']));
        </script>
    @endif
</x-app-layout>