@php
use App\Models\User;
use App\Models\Song;
use App\Models\Genre;
@endphp

@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        @switch(request()->route()->uri)
        @case('admin/panel')
           <h1>ADMIN PANEL</h1>
            <div id="buttons">
                <a class="link" href="/admin/users">Users</a>
                <a class="link" href="/admin/songs">Songs</a>
                <a class="link" href="/admin/genress">Genres</a>
            </div>
            <div style="margin: 0 auto; width: 500px;">
                <img src="{{ asset('img/monkeyadmin.gif') }}" alt="nie boos doen" height="500" width="500">
            </div>
        @break

        @case('admin/users')
            <h1><a class="hidden-link"  href="/admin/panel">ADMIN PANEL</a> > GEBRUIKERS</h1>
            <div id="users">
                @foreach (User::all() as $User)
                    <table class="admin-table">
                            <tr>
                                <td class="td-name">Id</td>
                                <td class="td-data">{{ $User->id }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Role Id</td>
                                <td class="td-data">{{ $User->role_id }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Naam</td>
                                <td class="td-data">{{ $User->username }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Wachtwoord</td>
                                <td class="td-data"><a class="td-password" onclick="alert('Dit is niet het echte wachtwoord, hij is encrypted')">{{ $User->password }}</a></td>
                            </tr>
                            <tr>
                                <td class="td-name">Datum Gemaakt</td>
                                <td class="td-data">{{ $User->date_created }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Verwijderd</td>
                                <td class="td-data">{{ $User->deleted }}</td>
                            </tr>
                    </table>
                @endforeach
            </div>
        @break

        @case('admin/songs')
            <h1><a class="hidden-link"  href="/admin/panel">ADMIN PANEL</a> > LIEDJES <a class="hidden-link" href="/song/create">+</a></h1>
            <div id="songs">
                @foreach (Song::all() as $Song)
                    <table class="admin-table">
                            <tr>
                                <td class="td-name">Id</td>
                                <td class="td-data">{{ $Song->id }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Genre Id</td>
                                <td class="td-data">{{ $Song->genre_id }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Naam</td>
                                <td class="td-data">{{ $Song->name }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Lengte</td>
                                <td class="td-data">{{ $Song->length }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Artiest</td>
                                <td class="td-data">{{ $Song->artist }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Cover Art</td>
                                <td class="td-data">{{ $Song->cover_art }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Datum Gemaakt</td>
                                <td class="td-data">{{ $Song->date_created }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Datum Toegevoegd</td>
                                <td class="td-data">{{ $Song->date_added }}</td>
                            </tr>
                            <tr>
                                <td class="td-name">Verwijderd</td>
                                <td class="td-data">{{ $Song->deleted }}</td>
                            </tr>
                    </table>
                @endforeach
            </div>
        @break

        @case('admin/genress')
            <h1><a class="hidden-link"  href="/admin/panel">ADMIN PANEL</a> > GENRES <a class="hidden-link" href="/genre/create">+</a></h1>
            <div id="genress">
                @foreach (Genre::all() as $Genre)
                    <a class="hidden-link" href="/genre/<?= $Genre->id ?>">
                        <table class="admin-table">
                                <tr>
                                    <td class="td-name">Id</td>
                                    <td class="td-data">{{ $Genre->id }}</td>
                                </tr>
                                <tr>
                                    <td class="td-name">Naam</td>
                                    <td class="td-data">{{ $Genre->name }}</td>
                                </tr>
                                <tr>
                                    <td class="td-name">Rgb Kleur</td>
                                    <td class="td-data" style="color: {{ $Genre->rgb_color }}">{{ $Genre->rgb_color }}</td>
                                </tr>
                                <tr>
                                    <td class="td-name">Datum Gemaakt</td>
                                    <td class="td-data">{{ $Genre->date_created }}</td>
                                </tr>
                                <tr>
                                    <td class="td-name">Verwijderd</td>
                                    <td class="td-data">{{ $Genre->deleted }}</td>
                                </tr>
                        </table>
                    </a>
                @endforeach
            </div>
        @break

        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>