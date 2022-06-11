@php
use App\Models\Genre;
@endphp

@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        @if (request()->route()->uri == 'genres')
            <div id="genres-full">
                @foreach (Genre::all()->shuffle() as $Genre)
                <a class="hidden-link" href="/genre/<?= $Genre->id ?>">
                    <div class="genre-full" style="background-color: {{ $Genre->rgb_color }}">
                        <b>
                            {{ $Genre->name }}
                        </b>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <h1 style="color: {{ $rgb_color }}">{{ $name }}</h1>
        @endif
    </div>

    @include("layout/footer")
</body>

</html>