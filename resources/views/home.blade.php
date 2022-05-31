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
    </div>

    @include("layout/footer")
</body>

</html>