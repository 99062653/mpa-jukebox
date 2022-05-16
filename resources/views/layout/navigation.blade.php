<?php



?>
<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid ">
		<a class="navbar-brand">
			<img src="../img/logo.gif" alt="JukeBox_logo" width="250">
		</a>
		@if (1==1)
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