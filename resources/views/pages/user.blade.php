@include("layout/header")

<body>
    @include("layout/nav")
    
    <div id="content">
        <h1>Account overview,</h1>
        <h2>Profiel</h2>
        <table>
            <tr>
                <td class="td-name">Naam</td>
                <td class="td-data">{{ $username }}</td>
            </tr>
            <tr>
                <td class="td-name">Wachtwoord</td>
                <td class="td-data"><a class="td-password" onclick="alert('Dit is niet je echte wachtwoord, hij is encrypted')">{{ $password }}</a></td>
            </tr>
            <tr>
                <td class="td-name">Datum gemaakt</td>
                <td class="td-data">{{ $date_created }}</td>
            </tr>
        </table>

        <h2>Playlists <a class="hidden-link" href="/playlist/create">+</a></h2>

        <table>
            @if (!session('playlists'))
                <tr>
                    <td class="td-create">het is nogal leeg hier :( <br /><b><a href="/playlist/create">maak een playlist</a></b></td>
                </tr>
            @else
                <div id="playlists">
                    @foreach (session('playlists') as $Playlist)
                    @if ($loop->index == 15)
                        @break 
                    @endif
                    <a class="hidden-link" href="/user/playlist/<?= $Playlist['id'] ?>">
                        <div class="playlist" style="background-color: {{ $Playlist['rgb_color'] }}">
                            <b>
                                {{ $Playlist['name'] }}
                            </b>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </table>
    </div>

    @include("layout/footer")
</body>

</html>