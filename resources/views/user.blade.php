@include("layout/header")

<body>
    @include("layout/nav")
    
    <div id="content">
        <h1>Account overview,</h1>
        <h2>Profiel</h2>

        <table>
            <tr>
                <td class="td-name">Naam</td>
                <td class="td-data">{{ session('user')['name'] }}</td>
            </tr>
            <tr>
                <td class="td-name">Wachtwoord</td>
                <td class="td-data"><a class="td-password" onclick="alert('Dit is niet je echte wachtwoord, hij is encrypted')">{{ session('user')['password'] }}</a></td>
            </tr>
            <tr>
                <td class="td-name">Datum gemaakt</td>
                <td class="td-data">{{ session('user')['created_on'] }}</td>
            </tr>
        </table>

        <h2>Playlists</h2>

        <table>
            @if (!session('playlists'))
                <tr>
                    <td class="td-create">het is nogal leeg hier :( <br /><b><a href="/playlist/create">maak een playlist</a></b></td>
                </tr>
            @else
                <tr>
                    @foreach (session('playlists') as $playlist)
                        <td class="td-edit"><b><a href="#"><?= $playlist['name'] ?></a></b></td>
                
                    @endforeach
                </tr>
            @endif
        </table>
    </div>

    @include("layout/footer")
</body>

</html>