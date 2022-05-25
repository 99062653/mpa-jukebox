@include("layout/header")

<body>

    <div id="content">
        <div id="form">
            <form action="/user/login" method="POST">
                @csrf {{-- dit zorgt voor veiligheid ofzo --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $username ?? '' }}{{--ternory operator. soortvan isset--}}" required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                </div>
                <span class="error">{{ $issue ?? '' }}</span>
                <input type="button" class="link" onclick="location.href='/';" value="Terug" />
                <input type="submit" class="link" value="Login" />
            </form>
        </div>
    </div>

</body>

</html>