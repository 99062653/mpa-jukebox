@include("layout/header")

<body>
    @include("layout/navigation")

    <div id="content">
        <div id="form">
            <form action="/22" method="POST">
                @csrf {{-- dit zorgt voor veiligheid ofzo --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                </div>
                <div class="form-group">
                    {{-- ERROR MESSAGE HIER --}}
                </div>
                <input type="button" class="link" onclick="location.href='/';" value="Terug" />
                <input type="submit" class="link" value="Login" />
            </form>
        </div>
    </div>

    @include("layout/footer")
</body>

</html>