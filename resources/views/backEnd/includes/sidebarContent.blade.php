<!-- Main sidebar -->

	<div class="sidebar sidebar-main">
		<div class="sidebar-content">

			<!-- User menu -->
			<div class="sidebar-user">
				<div class="category-content">
					<div class="media">
						<a href="#" class="media-left">
							<?php $avater = Auth::User()->avater; if(!file_exists($avater)){ $avater = 'public/backEnd/images/placeholder.jpg';}?>
							<img src="{{ asset($avater)}}" alt="{{ Auth::user()->name }}" height="40" width="40" class="img-circle img-md"> 
						</a>
						<div class="media-body">
							<span class="media-heading text-semibold ">{{ Auth::user()->name }}</span>
							<div class="text-size-mini text-muted">
								<i class="icon-user-check text-size-small"></i> &nbsp;{{  Auth::user()->authority == 1 ? 'Super Admin' : 'Admin' }}
							</div>
						</div>

						<div class="media-right media-middle">
							<ul class="icons-list">
								<li>
									
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /user menu -->


			<!-- Main navigation -->
			<div class="sidebar-category sidebar-category-visible">
				<div class="category-content no-padding">
					<ul class="navigation navigation-main navigation-accordion">
					
						<!-- Main -->
						<li class="navigation-header"><span>Side Bar</span> <i class="icon-menu" title="Main pages"></i></li>
						<li class="{{ (Route::currentRouteName() == 'dashboard') ?'active' : ' ' }}"><a href="{{ route('dashboard')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
						<li class="{{ (Request::route()->getPrefix() == '/depertment') ?'active' : ' ' }}" ><a href="{{ route('depertment')}}"><i class="icon-hammer-wrench"></i> <span>Depertment</span></a></li>
						<li class="{{ (Request::route()->getPrefix() == '/paymentSystem') ?'active' : ' ' }}" ><a href="{{ route('paymentSystem')}}"><i class=" icon-coins"></i> <span>Payment System</span></a></li>
						<li class="{{ (Request::route()->getPrefix() == '/worker' || Request::route()->getPrefix() == '/singel/worker' ) ?'active' : ' ' }}" ><a href="{{ route('worker')}}"><i class="icon-users4"></i> <span>Worker Info</span></a></li>
						<li class="{{ (Request::route()->getPrefix() == '/salary') ?'active' : ' ' }}" ><a @if(in_array(13 ,$admin_roles)) href="{{ route('salarys')}}" @else class="noty-runner" data-layout="top" data-type="warning" @endif><i class="icon-cash4"></i> <span>Worker Salary</span></a></li>
						<li class="{{ (Route::currentRouteName() == 'attendance.form') ?'active' : ' ' }}"><a @if(in_array(16 ,$admin_roles)) href="{{ route('attendance.form')}}" @else class="noty-runner" data-layout="top" data-type="warning" @endif ><i class="icon-thumbs-up3"></i> <span>Attendance Form</span></a></li>
						
					</ul>
				</div>
			</div>
			<!-- /main navigation -->

		</div>
	</div>
<!-- /main sidebar-->