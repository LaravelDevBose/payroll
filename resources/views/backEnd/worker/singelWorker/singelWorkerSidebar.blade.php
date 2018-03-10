<?php 
require 'vendor/autoload.php';
use Carbon\Carbon;
$datetime= Carbon::now();
$month = $datetime->month;
$year = $datetime->year;
?>

<div class="sidebar-detached">
	<div class="sidebar sidebar-default sidebar-separate" >
		<div class="sidebar-content">

			<!-- User details -->
			<div class="content-group">
				<div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
					<div class="content-group-sm">
						<h6 class="text-semibold no-margin-bottom">
							{{ strtoupper( $singelworker->name ) }}
						</h6>

						<span class="display-block">{{ $singelworker->deptName }}</span>
					</div>

					<a href="#" class="display-inline-block content-group-sm">
						<img src="{{ asset( $singelworker->image ) }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
					</a>
				</div>

				<div class="panel no-border-top no-border-radius-top">
					<ul class="navigation">
						<li class="navigation-header">Navigation</li>
						<li class="{{ (Route::currentRouteName() =='profile') ?'active' : ' ' }}"><a href="{{ route('profile',$id ) }}" ><i class="icon-files-empty"></i> Profile</a></li>
						<li class="{{ (Route::currentRouteName() =='attendes') ?'active' : ' ' }}"><a href="{{ route('attendes',['id'=>$id, 'month'=>$month,'year'=>$year]) }}" ><i class="icon-files-empty"></i> Attendes</a></li>
						<li class="{{ (Route::currentRouteName() =='payment.history') ?'active' : ' ' }}"><a href="{{ route('payment.history',$id ) }}" ><i class="icon-files-empty"></i> Payment </a></li>
						

						<li><a @if(in_array(11,$admin_roles)) href="{{ route('worker.edit', $id) }}" @else onclick="alert('You Are Not Able For This Option')" @endif  ><i class="icon-files-empty"></i> Edit</a></li>
						<li class="navigation-divider"></li>
						<li><a href="#"><i class="icon-switch2"></i> Delete</a></li>
					</ul>
				</div>
			</div>
			
		</div>
	</div>
</div>