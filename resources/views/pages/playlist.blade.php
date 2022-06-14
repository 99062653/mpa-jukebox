@include("layout/header")

<body>

    <div id="content">
        @switch(request()->route()->uri())
            @case('playlist')

                @break

            @case('playlist/edit')
                    
                @break

            @case('playlist/create')
                <div id="form">
                    <form action="/playlist/create" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $name ?? '' }}" required />
                        </div>
                        <div class="form-group">
                            <label for="color">Rgb Kleur</label>
                            <input type="color" name="color" class="form-control" required />
                        </div>
                        <a type="button" class="link back" href="{{ url()->previous() }}">Terug</a>
                        <input type="submit" class="link" value="Create" />
                    </form>
                </div>
                @break
            @default
                @include("layout/nav")
                <h1 style="color: {{ $rgb_color }}">{{ $name }}
                    @if (str_contains(url()->current(), 'user')) 
                        <a class="hidden-link" href="/user/playlist/{{ $id }}/edit"><i class="bi bi-pencil-square"></i></a>
                    @endif
                </h1>
                <div id="songs">
                    <table>
                        <tr>
                            <th><i class="bi bi-image"></i></th>
                            <th>Naam</th>
                            <th>Artiest</th>
                            <th>Genre</th>
                            <th><i class="bi bi-clock"></i></th>
                            <th>Datum Toegevoegd</th>
                        </tr>
                        @foreach (session('playlists')[$id - 1]['songs'] as $Song)
                                <tr>
                                    <td><img class="song-art" src="{{ asset('img/logo.gif') }}" width="50" height="50" alt="test"></td>
                                    <td>{{ $Song['name'] }}</td>
                                    <td>artiest</td>
                                    <td>Genre</td>
                                    <td>4:00</td>
                                    <td>26-04-1942</td>
                                </tr>
                        @endforeach
                    </table>
                </div>
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>