@include("layout/header")
<?php

use Carbon\Carbon;

?>
<body>
    @include("layout/navigation")
    <div id="content">
        @include("functionally/time")
    </div>

    @include("layout/footer")
</body>

</html>