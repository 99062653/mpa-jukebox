@include("layout/header")

<body>
    @include("layout/nav")

    <div id="content">
        <h1 style="color: {{ $rgb_color }}">{{ $name }}</h1>
    </div>

</body>

</html>