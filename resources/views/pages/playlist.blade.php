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
                    @csrf {{-- dit zorgt voor veiligheid ofzo --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name"
                            value="{{ $name ?? '' }}{{--ternory operator. soortvan isset--}}" required />
                    </div>
                    <input type="button" class="link" onclick="history.back();" value="Terug" />
                    <input type="submit" class="link" value="Create" />
                </form>
            </div>
        @break
        @endswitch
    </div>

</body>

</html>