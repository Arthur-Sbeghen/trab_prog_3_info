<x-app-layout>
        <nav>
            <h2>Filter</h2>
            <form action="">
                <div>
                    Search
                    <select name="" id="">
                        <option value="">Name</option>
                        <option value="">Especific Year</option>
                    </select>
                    <input type="submit" value="">
                </div>
                <div>
                    Year
                    <button type="submit">
                        asc
                    </button>
                    <button type="submit">
                        desc                        
                    </button>
                </div>
                <div>
                    Category
                    <select type="submit" name="" id="">

                    </select>
                </div>
            </form>
        </nav>
        @if (Auth()->user() && Auth()->user()->is_admin)
            <form action="{{ route('movie.create') }}">
                <button type="submit">Add Movie</button>
            </form>
        @endif
        <main>
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
        </main>
</x-app-layout>
