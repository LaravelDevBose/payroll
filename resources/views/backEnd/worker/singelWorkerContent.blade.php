@extends('backEnd.master')

@section('title')
Singel-Worker
@endsection

@section('assetlink')

<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/visualization/echarts/echarts.js')}}"></script>

	<script type="text/javascript" src="{{ asset('public/backEnd/js/core/app.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/pages/ecommerce_customers.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/backEnd/js/pages/user_profile_tabbed.js')}}"></script>
	<!-- /theme JS files -->

@endsection

@section('content')

@include('backEnd.includes.massageContent')
 
<!-- Detached sidebar -->
@include('backEnd.worker.singelWorker.singelWorkerSidebar')
<!-- /detached sidebar -->


<!-- Detached content -->
<div class="container-detached">
	<div class="content-detached">

		<!-- Tab content -->
		<div class="tab-content">


			@yield('tabContent')
			
		</div>
		<!-- /tab content -->

	</div>
</div>
<!-- /detached content -->

@endsection