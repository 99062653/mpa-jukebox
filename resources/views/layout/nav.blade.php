<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid ">
		<a class="navbar-brand" href="/">
			<img src="{{ asset('img/logo.gif') }}" alt="JukeBox_logo" width="250">
		</a>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ms-auto">
				@if (!session('user_id'))
					<li class="nav-item">
						<a class="nav-link" href="/user/login">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/user/register">Register</a>
					</li>
				@else
					<li class="nav-item">
						<div class="dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
								data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-person-circle"></i>
							</a>
			
							<ul class="dropdown-menu" id="dropdown-list" aria-labelledby="dropdownMenuLink">
								<li><a class="dropdown-item" href="/user"><i
											class="bi bi-person-circle dropdown-icon"></i>Account</a></li>
								@if (session('user_admin'))
									<li><a class="dropdown-item" href="/admin/panel"><i class="bi bi-webcam dropdown-icon"></i>Panel</a></li>
								@endif
								<li><a class="dropdown-item" href="/user/logout"><i class="bi bi-box-arrow-left dropdown-icon"></i>Logout</a></li>
							</ul>
						</div>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>