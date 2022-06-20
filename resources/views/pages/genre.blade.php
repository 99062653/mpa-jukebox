@php
use App\Models\Genre;
use App\Models\Song;
@endphp

@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        @switch(request()->route()->uri())
            @case('genres')
                <div id="genres-full">
                    @foreach (Genre::all()->shuffle() as $Genre)
                    <a class="hidden-link" href="/genre/<?= $Genre->id ?>">
                        <div class="genre-full" style="background-color: {{ $Genre->rgb_color }}">
                            <b>
                                {{ $Genre->name }}
                            </b>
                        </div>
                    </a>
                    @endforeach
                </div>
                @break
            @case('genres/edit')
                
                @break
            @default
                <h1 style="color: {{ $rgb_color }}">{{ $name }}</h1>
                <div class="search-container">
                    <form action="#">
                        <div class="form-group">
                            <input type="text" class="form-control searchbar" placeholder="Search.." name="search">
                            <button type="submit" class="searchbar-link"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div id="songs">
                    <table>
                        <tr>
                            <th><i class="bi bi-image"></i></th>
                            <th>Naam</th>
                            <th>Artiest</th>
                            <th><i class="bi bi-clock"></i></th>
                            <th>Datum Gemaakt</th>
                            <th></th>
                        </tr>
                            @foreach (Song::all()->where('genre_id', $id) as $Song)
                                <tr>
                                    <td><img class="song-art" src="{{ $Song->cover_art }}" width="50" height="50" alt="cover-art"></td>
                                    <td>{{ $Song->name }}</td>
                                    <td>{{ $Song->artist }}</td>
                                    <td>{{ $Song->length }}</td>
                                    <td>{{ $Song->date_created }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="hidden-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="bi bi-plus-square-fill"></i>
                                            </a>
                                            <ul class="dropdown-menu" id="dropdown-list" aria-labelledby="dropdownMenuLink">
                                                @if (session('playlists'))
                                                    @foreach (session('playlists') as $Playlist)
                                                        @if ($Playlist['deleted'] == false)
                                                            <li><a class="dropdown-item" href="/user" style="color: {{ $Playlist['rgb_color'] }}"><i class="bi bi-folder-plus dropdown-icon"></i>{{ $Playlist['name'] }}</a></li>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <li><a class="dropdown-item" href="#">JE HEBT GEEN PLAYLISTS</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>