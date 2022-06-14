@php
use App\Models\Genre;
@endphp

@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        @switch(request()->route()->uri())
            @case('genres')
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
                @break
            @case('genres/edit')
                
                @break
            @default
                <h1 style="color: {{ $rgb_color }}">{{ $name }}</h1>
                <div class="search-container">
                    <form action="#">
                        <div class="form-group">
                            <input type="text" class="form-control searchbar" placeholder="Search.." name="search">
                            <button type="submit" class="searchbar-link"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div id="songs">
                    {{-- foreach hier --}}
                </div>
        @endswitch
    </div>

    @include("layout/footer")
</body>

</html>