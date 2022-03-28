<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menu-light ">
	<div class="navbar-wrapper  ">
		<div class="navbar-content scroll-div " >
			
			<div class="">
				<div class="main-menu-header">
					<img class="img-radius" src="/admin/assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
					<div class="user-details">
						<div id="more-details">UX Designer <i class="fa fa-caret-down"></i></div>
					</div>
				</div>
				<div class="collapse" id="nav-user-link">
					<ul class="list-inline">
						<li class="list-inline-item"><a href="user-profile.html" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
						<li class="list-inline-item"><a href="email_inbox.html"><i class="feather icon-mail" data-toggle="tooltip" title="Messages"></i><small class="badge badge-pill badge-primary">5</small></a></li>
						<li class="list-inline-item"><a href="auth-signin.html" data-toggle="tooltip" title="Logout" class="text-danger"><i class="feather icon-power"></i></a></li>
					</ul>
				</div>
			</div>
			
			<ul class="nav pcoded-inner-navbar ">
				<li class="nav-item pcoded-menu-caption">
					<label>Navigation</label>
				</li>
				<li>
					<a href="/admin" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
				</li>
				<li class="nav-item pcoded-hasmenu">
					<a href="#services" class="nav-link "><span class="pcoded-micon"><i class="feather icon-grid"></i></span><span class="pcoded-mtext">Services</span></a>
					<ul class="pcoded-submenu">
						<li><a href="/admin/services" target="_blank">All Services</a></li>
						<li><a href="/admin/services/categories" target="_blank">Categories</a></li>
					</ul>
				</li>
                @can('user_management_access')
				<li class="nav-item pcoded-hasmenu">
					<a href="#services" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">User Management</span></a>
					<ul class="pcoded-submenu">
						<li><a href="{{ route("admin.users.index") }}"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Users</span></a></li>
						<li><a href="{{ route("admin.permissions.index") }}"><span class="pcoded-micon"><i class="feather icon-unlock"></i></span><span class="pcoded-mtext">Permissions</span></a></li>
						<li><a href="{{ route("admin.roles.index") }}"><span class="pcoded-micon"><i class="feather icon-briefcase"></i></span><span class="pcoded-mtext">Roles</span></a></li>
					</ul>
				</li>
                @endcan
			</ul>
			
			<div class="card text-center">
				<div class="card-block">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="feather icon-sunset f-40"></i>
					<h6 class="mt-3">Help?</h6>
					<p>Please contact us on our email for need any support</p>
					<a href="mailto:a.rahman@msac.ae" target="_blank" class="btn btn-primary btn-sm text-white m-0">Support</a>
				</div>
			</div>
			
		</div>
	</div>
</nav>
<!-- [ navigation menu ] end -->