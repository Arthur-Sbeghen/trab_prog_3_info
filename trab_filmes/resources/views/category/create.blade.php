<x-app-layout>
    <div class="options">
        <a href="{{ route('category.list') }}" class="btn-type2"><i class="fa-solid fa-arrow-left"></i> Back to Categories</a>
    </div>
    <h1>Add New Category</h1>
    <form action="{{ route('category.store') }}" method="POST" class="form-edit">
        @csrf
        @method('POST')

        <div class="input-div">
            <label for="name" class="basic-label">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="basic-input" required>
        </div>

        <button type="submit" class="submit">Submit</button>
    </form>
    @if ($alert = session('alert'))
        <script>
            showAlert(@json($alert['message']), @json($alert['type']));
        </script>
    @endif
</x-app-layout>