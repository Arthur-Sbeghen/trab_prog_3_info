<x-app-layout>
    <h1>Add New Category</h1>
    <a href="{{ route('category.list') }}">Back</a>
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="input-div">
            <label for="name" class="basic-label">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="basic-input" required>
        </div>

        <button type="submit">Submit</button>
    </form>
    @if ($alert = session('alert'))
        <script>
            showAlert(@json($alert['message']), @json($alert['type']));
        </script>
    @endif
</x-app-layout>