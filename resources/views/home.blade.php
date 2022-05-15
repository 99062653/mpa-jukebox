<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('/css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
</head>

<body class="antialiased">
    <nav class="navbar fixed-top navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fixed top</a>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </nav>

</body>

</html>