@php

$route = request()->route()->uri; // haal de huidige URI op: zoals login of register

@endphp
<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid ">
		<a class="navbar-brand" href="/">
			<img src="../img/logo.gif" alt="JukeBox_logo" width="250">
		</a>
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav ms-auto">
					@if (!session('user'))
						<li class="nav-item">
							<a class="nav-link" href="/user/login">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/user/register">Register</a>
						</li>
					@elseif ($route != '/')
						<li class="nav-item">
							<a class="nav-link" href="/">Home</a>
						</li>
					@else
						<li class="nav-item">
							<div class="dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi bi-person-circle"></i>
								</a>
							  
								<ul class="dropdown-menu" id="dropdown-list" aria-labelledby="dropdownMenuLink">
								  <li><a class="dropdown-item" href="/user">Account</a></li>
								  <li><a class="dropdown-item" href="/user/logout">Logout</a></li>
								</ul>
							</div>
						</li>
					@endif
				</ul>
			</div>
	</div>
</nav>