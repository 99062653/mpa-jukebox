@php
    use App\Models\Role;
@endphp

@include("layout/header")

<body>

    @switch(request()->route()->uri())
        @case('user')
        @php
            if (session('user_id')) {
                $Role = Role::all()->where('id', $role_id)->first();
            }
        @endphp
            @include("layout/nav")
        
            <div id="content">
                <h1>Account overview</h1>
                <h2>Profiel</h2>
                <table>
                    <tr>
                        <td class="td-name">Naam</td>
                        <td class="td-data">{{ $username }}</td>
                    </tr>
                    <tr>
                        <td class="td-name">Rol</td>
                        <td class="td-data">{{ $Role->name }}</td>
                    </tr>
                    <tr>
                        <td class="td-name">Wachtwoord</td>
                        <td class="td-data"><a class="td-password" onclick="alert('Dit is niet je echte wachtwoord, hij is encrypted')">{{ $password }}</a><a class="hidden-link" href="/user/edit/password"><i class="bi bi-pencil-square td-icon"></i></a></td>
                    </tr>
                    <tr>
                        <td class="td-name">Datum gemaakt</td>
                        <td class="td-data">{{ $date_created }}</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
        
                <h2>Playlists <a class="hidden-link" href="/playlist/create"><i class="bi bi-plus-square-fill"></i></a></h2>
        
                <table>
                    @if (!session('playlists'))
                        <tr>
                            <td class="td-create">het is nogal leeg hier :( <br /><b><a href="/playlist/create">maak een playlist</a></b></td>
                        </tr>
                    @else
                        <div id="playlists">
                            @foreach (session('playlists') as $Playlist)
                                @if ($Playlist['deleted'] == false)
                                    <a class="hidden-link" href="/user/playlist/<?= $Playlist['id'] ?>">
                                    <div class="playlist" style="background-color: {{ $Playlist['rgb_color'] }}">
                                        <b>
                                            {{ $Playlist['name'] }}
                                            @if ($Playlist['saved'])
                                                <i class="bi bi-check"></i>
                                            @endif
                                        </b> 
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </table>
            </div>
            @break

        @case('user/edit/password')
            <div id="form">
                <form action="/user/edit/password" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="oldpass">Huidig Password</label>
                        <input type="password" name="oldpass" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="newpas">Nieuw Password</label>
                        <input type="password" name="newpass" class="form-control" />
                    </div>
                    <span class="error">{{ $issue ?? '' }}</span>
                    <a type="button" class="link back" href="/user">Terug</a>
                    <input type="submit" class="link" value="Update" />
                </form>
            </div>
            @break

        @default
            <div id="form">
                @switch(request()->route()->uri())
                    @case('user/login')
                        <form action="/user/login" method="POST">
                            @php ($value = 'Login')
                        @break
                    @case('user/register')
                        <form action="/user/register" method="POST">
                            @php ($value = 'Register')
                        @break
                @endswitch
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username"
                            value="{{ $username ?? '' }}" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required />
                    </div>
                    <span class="error">{{ $issue ?? '' }}</span>
                    <a type="button" class="link back" href="/">Terug</a>
                    <input type="submit" class="link" value="{{ $value }}" />
                </form>
            </div>
            @break
            
    @endswitch

    @include("layout/footer")
</body>

</html>