<?php

use Carbon\Carbon;

?>
@switch($t = date("h", strtotime(Carbon::now())))
            @case($t > 06 && $t < 12)
            <h1>Goedemorgen,</h1>
            @break

            @case($t > 12 && $t < 18)
            <h1>Goedemiddag,</h1>
            @break

            @case($t > 18 && $t > 24)
            <h1>Goedeavond,</h1>
            @break

            @case($t > 00 && $t < 06)
            <h1>Goedenacht,</h1>
            @break

            @default
            <h1>Welkom,</h1>
            @break
@endswitch