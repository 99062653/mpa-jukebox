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
            <tr>
                <td>het is nogal leeg hier :(</td>
            </tr>
        </table>
    </div>

    @include("layout/footer")
</body>

</html>