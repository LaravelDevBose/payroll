@extends('backEnd.master')

@section('title')
Worker
@endsection

@section('assetlink')

<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/visualization/echarts/echarts.js')}}"></script>

	<script type="text/javascript" src="{{ asset('public/backEnd/js/core/app.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/pages/ecommerce_customers.js')}}"></script>
<!-- /theme JS files -->

@endsection

@section('content')

<!-- Customers --> 
<div class="panel panel-flat">
	<div class="panel-heading">
		<h6 class="panel-title">Show Worker Info</h6>
		<div class="heading-elements">
			<div class="form-group">
                	<a @if(in_array(10, $admin_roles)) href="{{ route('worker.insert') }}" class="btn btn-info btn-block"  @else class="btn btn-info btn-block noty-runner" data-layout="top" data-type="warning"  @endif ><strong> Insert Workers (+) </strong> </a>
                </div>
    	</div>
	</div>
	<hr>

	
	@include('backEnd.includes.massageContent')

	<table class="table table-striped text-nowrap table-customers">
		<thead>
			<tr>
				<th width="20">SL.</th>
				<th>Avator</th>
				<th>Name</th>
				<th>Depertment</th>
				<th>Phone No</th>
				<th>Payment Type</th>
				<th>Basic Salary/Wages</th>
				<th>Over Time</th>
				<th>Actions</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@if( !count($workersInfo) == 0)

			@foreach( $workersInfo as $workerInfo )
			<tr>
				<td> {{ $loop->iteration }} </td>
				<td>
					<div class="media">
						<a href="{{ route('profile',$workerInfo->id) }}" class="media-left">
							<img src="{{ asset( $workerInfo->image ) }}" width="40" height="40" class="img-circle img-md" alt="">
						</a>
					</div>
				</td>
				<td>
					<div class="media">
						<div class="media-body media-middle">
							<a href="{{ route('profile',$workerInfo->id) }}" class="text-semibold"> {{ $workerInfo->name }} </a>
							<div class="text-muted text-size-small">
								{{ $workerInfo->workerViewId }}
							</div>
						</div>
					</div>
				</td>
				<td> {{ $workerInfo->deptName }} </td>
				<td> {{ $workerInfo->phoneNo }} </td>
				<td> {{ $workerInfo->paymentTitle }} </td>
				<td>{{ $workerInfo->amount }}Tk</td>
				<td> {{$workerInfo->timeLimit }} </td>
				<td class="text-right">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu7"></i>
								<span class="caret"></span>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ url('singel/worker/profile/'.$workerInfo->id) }}"><i class="icon-file-eye2"></i>Full View</a></li>
								<li class="divider"></li>
								<li><a @if(in_array(11,$admin_roles)) href="{{ url('worker.edit'. $workerInfo->id) }}" @else class="noty-runner" data-layout="top" data-type="warning"  @endif ><i class="icon-pencil7"></i> Edit</a></li>
								<li><a @if(in_array(12,$admin_roles)) href="{{ url('worker.delete', $workerInfo->id) }}" @else class="noty-runner" data-layout="top" data-type="warning"  @endif ><i class="icon-bin"></i>Delete</a></li>
								
							</ul>
						</li>
					</ul>
				</td>
				<td class="no-padding-left"></td>
			</tr>
			@endforeach
		@else
			<tr>
	            <td colspan="10"> 
	                <p class="alert alert-info text-center"> No worker  Information Insert. <br> Please Insert Worker Information ..! </p>
	            </td>
	        </tr>
		@endif
		</tbody>
	</table>
</div>
<!-- /worker details -->

@endsection