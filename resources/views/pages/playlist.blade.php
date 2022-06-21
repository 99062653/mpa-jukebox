@php
use App\Models\User;
use App\Models\Genre;
$User = User::where('id', session('user_id'))->first();
$Length = 0;

if (session('playlists') && isset($id)) {
    foreach (session('playlists')[$id - 1]['songs'] as $Song) {
        $Length += ceil((float)str_replace(':', '.', $Song['length'])); //cast als float en ceil round hem up
    }
}

@endphp

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
                            <a class="hidden-link" href="/user">{{ $User->username }}</a>
                            -
                            {{ count(session('playlists')[$id - 1]['songs']) }} Songs,
                            {{ $Length }} Minuten
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
                                @foreach (session('playlists')[$id - 1]['songs'] as $Song)
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

                            @endif
                        </table>
                    </div>
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>