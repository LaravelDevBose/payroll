@extends('backEnd.master')

@section('title')
Asmin-Show
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
<style>.c_width{width:10px;}</style>
@endsection

@section('content')
@include('backEnd.includes.massageContent')
<div class="row">
	<div class="col-md-12">
		<!-- Admin Info -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Admin Information</h6>
				<div class="heading-elements">
					<ul class="icons-list">
		        		
		        		<li><a @if(in_array(1, $admin_roles)) href="{{ route('admin.create') }}" class="btn btn-block btn-success " @else class=" btn btn-block btn-success noty-runner" data-layout="top" data-type="warning" @endif   style="color: #fff;"><i class="icon-user-plus"></i> sAdd Admin</a></li>
		        		<li><a data-action="reload"></a></li>
		        		
		        	</ul>
		    	</div>
			</div>

			<table class="table table-striped text-nowrap table-customers">
				<thead>
					<tr>
						<th class="c_width">Sl. No</th>
						<th>Image</th>
						<th>Name</th>
						<th>User Name</th>
						<th>Eamil</th>
						<th>Phone No.</th>
						<th>Status</th>
						<th class="text-center">Actions</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($admins as $admin)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>
							<div class="media">
								<a href="{{ route('admin.show', $admin->id) }}" class="media-left">
									<?php $avater = $admin->avater; if(!file_exists($avater)){ $avater = 'public/backEnd/images/placeholder.jpg';}?>
									<img src="{{ asset($avater)}}" width="40" height="40" class="img-circle img-md" alt="{{ $admin->name }}">
								</a>
							</div>
						</td>
						<td> <a href="{{ route('admin.show', $admin->id) }}" class="text-semibold">{{ $admin->name }}</a> </td>
						<td>{{ $admin->username }}</td>
						<td>{{ $admin->email }}</td>
						<td>{{ $admin->phone_number }}</td>
						<td>
							@if($admin->status ==1)
								<label class="text-semibold label label-success">Active</label>
							@else
								<label class="text-semibold label label-danger">Block</label>
							@endif
						</td>
						<td class="text-right">
							<a href="{{ route('admin.show',$admin->id) }}" class="btn btn-sm btn-info " title="View Admin"><i class="icon-eye"></i></a>
							<a @if(in_array(2,$admin_roles)) href="{{ route('admin.edit',$admin->id) }}" class="btn btn-sm btn-primary " @else class="btn btn-sm btn-primary  noty-runner" data-layout="top" data-type="warning" @endif  title="Edit Admin"><i class=" icon-pencil5"></i></a>
							@if(in_array(3, $admin_roles))
							<form  action="{{route('admin.destroy',$admin->id)}}" style="display: inline-block;" method="POST">
		                        {{ csrf_field()}}
		                        {{ method_field('DELETE')}}
		                        <button type="submit" class="btn btn-danger"><i class="icon-trash"></i></button>
		                    </form>

		                    @else
		                        <button type="button"  class="btn btn-danger btn-sm noty-runner" data-layout="top" data-type="warning"><i class="icon-trash"></i></button>

		                    @endif
						</td>
						<td class="no-padding-left"></td>
					</tr>

					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /Admin Info -->
	</div>
</div>


@endsection