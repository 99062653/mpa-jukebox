@php
    use App\Models\Genre;
    use App\Models\Playlist;
@endphp

@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        <div id="content-top">
            @include("funcs/time")
            {{-- <div class="search-container">
                <form action="#">
                    <div class="form-group">
                        <input type="text" class="form-control searchbar" placeholder="Search.." name="search">
                        <button type="submit" class="searchbar-link"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div> --}}
        </div>
        <div id="content-mid">
                <h2 id="h2-genres">Interessante Genres <span class="span-link"><a class="hidden-link" href="/genres">Alle</a></span></h2>
                <div id="genres">
                    @foreach (Genre::all()->shuffle() as $Genre)
                        @if ($loop->index == 15)
                            @break 
                        @endif
                        <a class="hidden-link" href="/genre/<?= $Genre->id ?>">
                            <div class="genre" style="background-color: {{ $Genre->rgb_color }}">
                                <b>
                                    {{ $Genre->name }}
                                </b>
                            </div>
                        </a>
                    @endforeach
                </div>
                <h2 id="h2-playlists">Jukebox Playlists<span class="span-link"><a class="hidden-link" href="/playlists">Alle</a></span></h2>
                <div id="playlists">
                    @foreach (Playlist::all()->where('user_id', '=', '1')->shuffle() as $Playlist)
                        @if ($loop->index == 15)
                            @break 
                        @endif
                        <a class="hidden-link" href="/playlist/<?= $Playlist->id ?>">
                            <div class="playlist" style="background-color: {{ $Playlist->rgb_color }}">
                                <b>
                                    {{ $Playlist->name }}
                                </b>
                            </div>
                        </a>
                    @endforeach
                </div>
        </div>
        <div id="content-bottom">

        </div>
    </div>

    @include("layout/footer")
</body>

</html>