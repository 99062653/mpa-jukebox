@php
use App\Models\Genre;
@endphp

@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        <div id="content-top">
            @include("funcs/time")
            <div class="search-container">
                <form action="#">
                    <div class="form-group">
                        <input type="text" class="form-control searchbar" placeholder="Search.." name="search">
                        <button type="submit" class="searchbar-link"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div id="content-mid">
            <div id="content-mid-genres">
                <h2><a class="hidden-link" href="genres">Genres</a></h2>
                <div id="genres">
                    @foreach (Genre::all() as $Genre)
                    <div class="genre" style="background-color: {{ $Genre->rgb_color }}">
                        <b>
                            <a class="hidden-link" href="/genre/<?= $Genre->id ?>">{{ $Genre->name }}</a>
                        </b>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="content-mid-songs">
                <h2><a class="hidden-link" href="songs">Songs</a></h2>
                <div id="songs">
                    {{-- loop hiero --}}
                    <div class="song">

                    </div>
                </div>
            </div>
            @if (session('user_id'))
                <div id="content-mid-playlists">
                    <h2><a class="hidden-link" href="playlist/create">Playlists</a></h2>
                    
                </div>
            @endif
        </div>
        <div id="content-bottom">

        </div>
    </div>

    @include("layout/footer")
</body>

</html>