@include("layout/header")

<body>
    <div id="content">
        @switch(request()->route()->uri())
            @case('song/create')
                <div id="form">
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $name ?? '' }}" required />
                        </div>
                        <div class="form-group">
                            <label for="artist">Artist</label>
                            <input type="text" name="artist" class="form-control" placeholder="Artist"
                                value="{{ $artist ?? '' }}" required />
                        </div>
                        <div class="form-group">
                            <label for="length">Length</label>
                            <input type="number" name="length" class="form-control" placeholder="0"
                                value="{{ $name ?? '' }}" required />
                        </div>
                        <div class="form-group">
                            <label for="cover">Cover art (link)</label>
                            <input type="text" name="cover" class="form-control" placeholder="..."
                                value="{{ $cover ?? '' }}" required />
                        </div>
                        <div class="form-group">
                            <label for="date">Datum</label>
                            <input type="date" name="date" class="form-control" placeholder="?"
                                value="{{ $name ?? '' }}" required />
                        </div>

                        <span class="error">{{ $issue ?? '' }}</span>
                        <a type="button" class="link back" href="{{ url()->previous() }}">Terug</a>
                        <input type="submit" class="link" value="Create" />
                    </form>
                </div>
                @break

                @case('song/edit')
                <div id="form">
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $name ?? '' }}" required />
                        </div>

                        <span class="error">{{ $issue ?? '' }}</span>
                        <a type="button" class="link back" href="{{ url()->previous() }}">Terug</a>
                        <input type="submit" class="link" value="Create" />
                    </form>
                </div>
                @break
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>