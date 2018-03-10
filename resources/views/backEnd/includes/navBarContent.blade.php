<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<a class="navbar-brand" href="index.html"><img src="{{asset('public/backEnd/images/logo_light.png')}}" alt=""></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			<li>
				<a class="sidebar-control sidebar-detached-hide hidden-xs">
					<i class="icon-drag-left"></i>
				</a>
			</li>
			@if(Route::currentRouteName() == 'attendance.form')
			<li><p class="navbar-text">Session Code: <span class="text-size-large text-danger"> 45-yu-892-354whds</span></p></li>
			@endif
		</ul>

		<ul class="nav navbar-nav navbar-right">

			

			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<?php $avater = Auth::User()->avater; if(!file_exists($avater)){ $avater = 'public/backEnd/images/placeholder.jpg';}?>
					<img src="{{ asset($avater)}}" alt="{{ Auth::user()->name }}" class="img-circle img-md"> 
					<span>{{ Auth::user()->name }}</span>
					<i class="caret"></i>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">

					<li><a href="{{ route('admin.index') }}"><i class="icon-user-plus"></i>Admin Setting</a></li>
					<li class="divider"></li>

					<li><a @if(in_array(18 ,$admin_roles)) href="{{ route('acount.edit', Auth::user()->id)}}" @else class="noty-runner" data-layout="top" data-type="warning" @endif><i class="icon-cog5"></i> Account settings</a></li>
					<li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- /main navbar -->