@php
use App\Models\Genre;
@endphp

@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        <div id="content-top">
            @include("funcs/time")
            <div class="search-container">
                <form action="#">
                    <div class="form-group">
                        <input type="text" class="form-control searchbar" placeholder="Search.." name="search">
                        <button type="submit" class="searchbar-link"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div id="content-mid">
            <div id="content-mid-genres">
                <h2>Interessante Genres</h2>
                <div id="genres">
                    @foreach (Genre::all()->shuffle() as $Genre)
                    <a class="hidden-link" href="/genre/<?= $Genre->id ?>">
                        <div class="genre" style="background-color: {{ $Genre->rgb_color }}">
                            <b>
                                {{ $Genre->name }}
                            </b>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="content-bottom">

        </div>
    </div>

    @include("layout/footer")
</body>

</html>