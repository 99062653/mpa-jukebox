@include("layout/header")

<body>

    <div id="content">
        @switch(request()->route()->uri)
            @case('playlist')

                @break

            @case('playlist/edit')

                @break

            @case('playlist/create')
                <div id="form">
                    <form action="/playlist/create" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $name ?? '' }}" required />
                        </div>
                        <a type="button" class="link back" href="{{ url()->previous() }}">Terug</a>
                        <input type="submit" class="link" value="Create" />
                    </form>
                </div>
                @break
        @endswitch
    </div>

</body>

</html>