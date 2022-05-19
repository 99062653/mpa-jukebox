@include("layout/header")

<body>
    @include("layout/navigation")

    <div id="content">
        <div id="form">
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" />
                </div>
                <input type="button" class="link" onclick="location.href='/';" value="Terug" />
                <input type="submit" class="link" value="Register" />
            </form>
        </div>
    </div>

    @include("layout/footer")
</body>

</html>