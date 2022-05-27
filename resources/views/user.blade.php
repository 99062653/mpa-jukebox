@include("layout/header")

<body>
    @include("layout/nav")
    
    <div id="content">
        <h1>Account overview,</h1>
        <h2>Profile</h2>

        <table>
            <tr>
                <td class="td-name">Username</td>
                <td class="td-data">{{ session('user')['name'] }}</td>
            </tr>
            <tr>
                <td class="td-name">Wachtwoord</td>
                <td class="td-data">{{ session('user')['password'] }}</td>
            </tr>
            <tr>
                <td class="td-name">Datum gemaakt</td>
                <td class="td-data">{{ session('user')['created_on'] }}</td>
            </tr>
        </table>

        <h2>Playlists</h2>
    </div>

    @include("layout/footer")
</body>

</html>