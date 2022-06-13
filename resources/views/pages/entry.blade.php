@include("layout/header")

<body>
    <div id="content">
        @switch(request()->route()->uri)
            @case('user/login')
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
                @break

            @case('user/register')
                <div id="form">
                    <form action="/user/register" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username"
                                value="{{ $username ?? '' }}" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                        </div>
                        <span class="error">{{ $issue ?? '' }}</span>
                        <a type="button" class="link back" href="/">Terug</a>
                        <input type="submit" class="link" value="Register" />
                    </form>
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
                        <a type="button" class="link back" href="{{ url()->previous() }}">Terug</a>
                        <input type="submit" class="link" value="Update" />
                    </form>
                </div>
                @break
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>