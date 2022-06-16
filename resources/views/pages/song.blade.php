@php
use App\Models\Genre;
@endphp

@include("layout/header")

<body>
    <div id="content">
        @switch(request()->route()->uri())
            @case('song/create')
                @if(session('user_admin') || session('user_producer'))
                    <div id="form">
                        <form action="/song/create" method="POST" style="height: 400px;">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    value="{{ $name ?? '' }}" required />
                            </div>
                            <div class="form-group">
                                <label for="genre">Genre</label>
                                <select class="form-select" name="genre">
                                    @foreach (Genre::all() as $Genre)
                                        <option value="{{ $Genre->id }}" style="color: {{ $Genre->rgb_color }}">{{ $Genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="artist">Artist</label>
                                <input type="text" name="artist" class="form-control" placeholder="Artist"
                                    value="{{ $artist ?? '' }}" required />
                            </div>
                            <div class="form-group">
                                <label for="length">Length</label>
                                <input type="text" name="length" class="form-control" placeholder="0:00"
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
                @endif
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