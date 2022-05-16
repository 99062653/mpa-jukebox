<?php

$route = request()->route()->uri; // haal de huidige URI op: zoals login of register

?>
<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid ">
		<a class="navbar-brand" href="/">
			<img src="../img/logo.gif" alt="JukeBox_logo" width="250">
		</a>
		@if ($route != "login" && $route != "register")
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link" href="/login">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=  '#' ?>">Register</a>
					</li>
				</ul>
			</div>
		@endif
	</div>
</nav>