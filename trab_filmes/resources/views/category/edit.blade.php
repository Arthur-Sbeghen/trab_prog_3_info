<x-app-layout>
    <div class="options">
        <a href="{{ route('category.list') }}" class="btn-type2"><i class="fa-solid fa-arrow-left"></i> Back to Categories</a>
    </div>
    <h1>Editing Category {{ $category->name }}</h1>
    
    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="form-edit">
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