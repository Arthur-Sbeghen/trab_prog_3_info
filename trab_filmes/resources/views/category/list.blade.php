<x-app-layout>
    @if (Auth()->user() && Auth()->user()->is_admin)
        <a href="{{ route('category.create') }}" class="btn-add">Add Category</a>
    @endif

    <main class="categories-list">
        @if (!empty($categories))
            <ul>
                @foreach ($categories as $category)
                    <li>{{ $category->name }}
                        <div>
                            <form action="{{ route('category.edit', $category->id) }}" method="post">
                                @csrf
                                <button type="submit" class="edit-btn">Edit</button>
                            </form>
                            <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Oops! Seems like there are no categories registered</p>
        @endif
    </main>
</x-app-layout>