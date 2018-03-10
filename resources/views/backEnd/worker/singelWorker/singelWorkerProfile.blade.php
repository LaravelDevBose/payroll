@extends('backEnd.worker.singelWorkerContent')

@section('tabContent')

<div class="tab-pane fade in active" id="profile">

<!-- Basic Information -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Basic Information</h5>
			<div class="heading-elements">
				<ul class="icons-list">
            		<li><a data-action="collapse"></a></li>
            		<li><a data-action="reload"></a></li>
            		{{--<li><a data-action="close"></a></li>--}}
            	</ul>
        	</div>
		</div>


		<div class="table-responsive">
			<table class="table table-borderless">
				
				<tbody>
					<tr>
						<th style="width:200px;"><p> Name :</p></th>
						<td><p>{{ $singelworker->name }}</p> </td>

						<th ><p> Id :</p></th>
						<td><p>{{ $singelworker->workerViewId }}</p> </td>
					</tr>
					<tr>
						<th><p>Depertment :</p></th>
						<td><p>{{ $singelworker->deptName }}</p>

						</td><th><p>Payment Type :</p></th>
						<td><p>{{ $singelworker->paymentType == 1? 'Daily Basis' : 'Mounthly' }}</p> </td>
					</tr>
					<tr>
						<th><p> Gender :</p></th>
						<td><p>{{ $singelworker->gender == 1 ? 'Male' : 'Female' }}</p> </td>

						<th><p> NID :</p></th>
						<td><p>{{ $singelworker->nationalId }}</p> </td>
						
					</tr>
					<tr>
						<th><p> Phone Number:</p></th>
						<td><p>{{ $singelworker->phoneNo }}</p> </td>

						<th><p> Email :</p></th>
						<td><p>{{ $singelworker->email }}</p> </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<!-- Basic Information -->

	

<div class="row">
<!-- Present Address Information -->
	<div class="col-md-6">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Present Address</h5>
				<div class="heading-elements">
					<ul class="icons-list">
	            		<li><a data-action="collapse"></a></li>
	            		<li><a data-action="reload"></a></li>
	            		{{--<li><a data-action="close"></a></li>--}}
	            	</ul>
	        	</div>
			</div>
			<div class="table-responsive">
				<table class="table table-borderless">
					<tbody>
					@if(!is_null($singelworker->preHouseNo))
						<tr>
							<th style="width:200px;"><p> House No. :</p></th>
							<td>{{ $singelworker->preHouseNo }}</td>
						</tr>
					@endif
					@if(!is_null($singelworker->preRoadNo))
						<tr>
							<th style="width:200px;"><p> Road No. :</p></th>
							<td>{{ $singelworker->preRoadNo }}</td>
						</tr>
					@endif
					@if(!is_null($singelworker->preVillage))
						<tr>
							<th style="width:200px;"><p> Village :</p></th>
							<td>{{ $singelworker->preVillage }}</td>
						</tr>
					@endif
						<tr>
							<th style="width:200px;"><p> Post Office :</p></th>
							<td>{{ $singelworker->preP_O }}</td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Police Station :</p></th>
							<td>{{ $singelworker->preP_S }}</td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Postal/Zip Code :</p></th>
							<td>{{ $singelworker->preP_C }}</td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Divition :</p></th>
							<td>{{ $singelworker->preDistrict }} </td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Country :</p></th>
							<td>{{ $singelworker->preCountry }} </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<!-- Present Address Information -->

<!-- Parmanent Address Information -->
	<div class="col-md-6">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Parmanemt Address</h5>
				<div class="heading-elements">
					<ul class="icons-list">
	            		<li><a data-action="collapse"></a></li>
	            		<li><a data-action="reload"></a></li>
	            		{{--<li><a data-action="close"></a></li>--}}
	            	</ul>
	        	</div>
			</div>
			<div class="table-responsive">
				<table class="table table-borderless">
					<tbody>
					@if(!is_null($singelworker->parHouseNo))
						<tr>
							<th style="width:200px;"><p> House No. :</p></th>
							<td>{{ $singelworker->parHouseNo }}</td>
						</tr>
					@endif
					@if(!is_null($singelworker->parRoadNo))
						<tr>
							<th style="width:200px;"><p> Road No. :</p></th>
							<td>{{ $singelworker->parRoadNo }}</td>
						</tr>
					@endif
					@if(!is_null($singelworker->parVillage))
						<tr>
							<th style="width:200px;"><p> Village :</p></th>
							<td>{{ $singelworker->parVillage }}</td>
						</tr>
					@endif
						<tr>
							<th style="width:200px;"><p> Post Office :</p></th>
							<td>{{ $singelworker->parP_O }}</td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Police Station :</p></th>
							<td>{{ $singelworker->parP_S }}</td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Postal/Zip Code :</p></th>
							<td>{{ $singelworker->parP_C }}</td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Divition :</p></th>
							<td>{{ $singelworker->parDistrict }} </td>
						</tr>
						<tr>
							<th style="width:200px;"><p> Country :</p></th>
							<td>{{ $singelworker->parCountry }} </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<!-- Parmanent Address Information -->
</div>
	

<!-- Other Atatch File Information -->
	{{--<div class="panel panel-flat">--}}
		{{--<div class="panel-heading">--}}
			{{--<h5 class="panel-title">Borderless table</h5>--}}
			{{--<div class="heading-elements">--}}
				{{--<ul class="icons-list">--}}
            		{{--<li><a data-action="collapse"></a></li>--}}
            		{{--<li><a data-action="reload"></a></li>--}}
            		{{--<li><a data-action="close"></a></li>--}}
            	{{--</ul>--}}
        	{{--</div>--}}
		{{--</div>--}}

		{{--<div class="table-responsive">--}}
			{{--<table class="table table-borderless">--}}
				{{----}}
				{{--<tbody>--}}
					{{--<tr>--}}
						{{--<th>Eugene</th>--}}
						{{--<td>@Kopyov</td>--}}
					{{--</tr>--}}
					{{--<tr>--}}
						{{--<td>Victoria</td>--}}
						{{--<td>@Vicky</td>--}}
					{{--</tr>--}}
					{{--<tr>--}}
						{{--<th>Eugene</th>--}}
						{{--<td>@Kopyov</td>--}}
					{{--</tr>--}}
					{{--<tr>--}}
						{{--<td>Victoria</td>--}}
						{{--<td>@Vicky</td>--}}
					{{--</tr>--}}
					{{----}}
				{{--</tbody>--}}
			{{--</table>--}}
		{{--</div>--}}
	{{--</div>--}}
<!-- Other Atatch File Information -->
</div>

@endsection