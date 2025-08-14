<x-app-layout>
    @if (Auth()->user() && Auth()->user()->is_admin)
        <div class="filters">
            <a href="{{ route('category.create') }}" class="new-link"><i class="fa-solid fa-plus"></i> Add Category</a>
        </div>
    @endif

    <main class="categories-list">
        @if ($categories->isNotEmpty())
            <ul>
                @foreach ($categories as $category)
                    <li>{{ $category->name }}
                        <div>
                            <form action="{{ route('category.edit', $category->id) }}" method="post">
                                @csrf
                                <button type="submit" class="edit-btn"><i class="fa-solid fa-pen"></i> Edit Category</button>
                            </form>
                            <form action="{{ route('category.destroy', $category->id) }}" method="post" onsubmit="{ return showConfirm(event, '{{ $category->name }}', 'category') }">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"><i class="fa-solid fa-trash-can"></i> Delete Category</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Oops! Seems like there are no categories registered</p>
        @endif
    </main>
    @if ($alert = session('alert'))
        <script>
            showAlert(@json($alert['message']), @json($alert['type']));
        </script>
    @endif
</x-app-layout>