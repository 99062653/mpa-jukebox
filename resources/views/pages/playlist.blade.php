@php
    use App\Models\User;
    use App\Models\Genre;
    use App\Models\Song;
    use App\Models\SongInPlaylist;
    use App\Http\Controllers\PlaylistController;
@endphp

@include("layout/header")

<body>

    <div id="content">
        @switch(request()->route()->uri())
            @case('user/playlist/create')
                <div id="form">
                    <form action="/user/playlist/create" method="POST">
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
                        <span class="error">{{ $issue ?? '' }}</span>
                        <a type="button" class="link back" href="/user">Terug</a>
                        <input type="submit" class="link" value="Create" />
                    </form>
                </div>
                @break

            @default
                @include("layout/nav")
                <div id="content-top">
                    <h1 id="playlist-name" style="color: {{ $rgb_color }}; font-size: 50px;">{{ $name }}</h1>
                    <div id="playlist-dropdown" class="dropdown">
                        <a class="playlist-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </a>
                        <ul class="dropdown-menu" id="dropdown-list" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/user/playlist/{{ $id }}/edit"><i class="bi bi-pencil-fill dropdown-icon"></i>Edit</a></li>
                            @if (!$saved)
                                <li><a class="dropdown-item" href="/user/playlist/{{ $id }}/save"><i class="bi bi-save-fill dropdown-icon"></i>Save</a></li>
                            @else
                                <li><a class="dropdown-item" href="/user/playlist/{{ $id }}/unsave"><i class="bi bi-save-fill dropdown-icon"></i>Unsave</a></li> 
                            @endif
                            <li><a class="dropdown-item" href="/user/playlist/{{ $id }}/delete"><i class="bi bi-eraser-fill dropdown-icon"></i>Delete</a></li>
                        </ul>
                    </div>
                </div>
                <h1 class="playlist-description">
                    <p>
                        {{ $amount }} Songs ~ {{ $length }} Minuten
                    </p>
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
                            <th></th>
                        </tr>
                        @if (str_contains(url()->current(), 'user')) 
                            @foreach (session('playlists')[PlaylistController::getPlaylistIndex($id)]['songs'] as $Song)
                            @php
                                $Genre = Genre::where('id', $Song['genre_id'])->first();
                            @endphp
                                    <tr>
                                        <td><img class="song-art" src="{{ $Song['cover_art'] }}" width="50" height="50" alt="cover-art"></td>
                                        <td>{{ $Song['name'] }}</td>
                                        <td>{{ $Song['artist'] }}</td>
                                        <td><a class="hidden-link" href="/genre/{{  $Song['genre_id'] }}">{{ $Genre->name }}</a></td>
                                        <td>{{ $Song['length'] }}</td>
                                        <td>{{ $Song['date_added'] }}</td>
                                        <td><a class="hidden-link" href="/user/playlist/{{ $id }}/remove/{{ $loop->index }}"><i class="bi bi-eraser"></i></a></td>
                                    </tr>
                            @endforeach

                        @else
                            @if (isset($songs['id']))
                                @foreach ($songs['id'] as $id)
                                @php
                                    $ActualSong = Song::where('id', $id)->first();
                                    $Genre = Genre::where('id', $ActualSong->id)->first();
                                @endphp
                                        <tr>
                                            <td><img class="song-art" src="{{ $ActualSong->cover_art }}" width="50" height="50" alt="cover-art"></td>
                                            <td>{{ $ActualSong->name }}</td>
                                            <td>{{ $ActualSong->artist }}</td>
                                            <td><a class="hidden-link" href="/genre/{{  $ActualSong->genre_id }}">{{ $Genre->name }}</a></td>
                                            <td>{{ $ActualSong->length }}</td>
                                            <td>{{ $ActualSong->date_added }}</td>
                                            <td></td>
                                        </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Deze playlist is leeg :/</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                        @endif
                    </table>
                </div>
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>