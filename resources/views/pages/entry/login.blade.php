@include("layout/header")

<body>

    <div id="content">
        <div id="form">
            <form action="/user/login" method="POST">
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
                <input type="submit" class="link" value="Login" />
            </form>
        </div>
    </div>

</body>

</html>