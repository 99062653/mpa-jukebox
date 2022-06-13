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
                        <div class="form-group">
                            <label for="color">Rgb Kleur</label>
                            <input type="color" name="color" class="form-control" required />
                        </div>
                        <a type="button" class="link back" href="{{ url()->previous() }}">Terug</a>
                        <input type="submit" class="link" value="Create" />
                    </form>
                </div>
                @break
            @default
                @include("layout/nav")
                <h1 style="color: {{ $rgb_color }}">{{ $name }} <a class="hidden-link" href="/userplaylist/{{ $id }}/edit"><i class="bi bi-pencil-square"></i></a></h1>
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>