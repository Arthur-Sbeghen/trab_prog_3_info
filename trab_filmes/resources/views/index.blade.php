<x-app-layout>
        <x-slot name="header">
            @if (Route::has('IsAdmin'))
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Movies') }}
                </h2>
            @endif
        </x-slot>
        <div> 
            @if (!empty($movies))
                @foreach ($movies as $id => $movie)
                    <div>
                        {{ $movie }}
                    </div>
                @endforeach
            @else
                <p>Não há filmes cadastrados, aguarde novidades!</p>
            @endif
        </div>
</x-app-layout>
