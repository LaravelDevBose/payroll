@extends('backEnd.worker.singelWorkerContent')
@section('tabContent')
<style type="text/css">.c_width{width: 10px !important;}</style>
<!-- Salary History -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h6 class="panel-title">Salary History</h6>
	</div>

	<table class="table table-striped text-nowrap table-customers">
		<thead>
			<tr>
                <th>Duration</th>
                <th>Payment Type</th>
                <th>Present</th>
                <th>Overtime</th>
                <th>O.T.Payment</th>
                <th>T.Payment</th>
                <th>Payable</th>
                <th>Act</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach( $workerPayment->salarys as $salary )
            <tr>
            	<td>demo</td>
                <td> {{ $salary->paymentType->paymentTitle }} </td>
                <td> {{ $salary->present }} </td>
                <td>{{ $salary->overtime }} Hours</td>
                <td> {{ number_format($salary->overtimeSalary) }} </td>
                <td id="{{ $salary->totalSalary }}"> {{ number_format($salary->totalSalary) }} </td>
                <td id="{{ $salary->totalSalary - $salary->paymentHistory->sum('amount') }}"> {{ number_format($salary->totalSalary - $salary->paymentHistory->sum('amount')) }} </td>
                <td class="text-right">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu7"></i>
								<span class="caret"></span>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><button type="button" class="btn btn-info btn-block payment" id="{{ $salary->id }}" data-toggle="modal" data-target="#payment_model"><i class="icon-cash4"></i> View Payment History</button></li>								
							</ul>
						</li>
					</ul>
				</td>
                <td class="no-padding-left"></td>
            </tr>
            @endforeach
		</tbody>
	</table>
</div>
<!-- /Salary History -->


<!-- Payment History -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h6 class="panel-title">Payment History</h6>
		
	</div>
	<table class="table table-striped text-nowrap table-customers">
		<thead>
			<tr>
				<th style="" class="c_width">Sl. No</th>
                <th>Paymet Date</th>
                <th>Salay To</th>
                <th>Salay Form</th>
                <th>Payed Amount</th>
                <th>Status</th>          
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($workerPayment->paymentHistory as $paymentHistory)
            <tr>
            	<td class="text-center">{{ $loop->iteration }}</td>
            	<td class="text-center"><?php $date = new DateTime($paymentHistory->created_at); echo date_format($date, 'd M Y'); ?></td>
                <td class="text-center"><?php $date = new DateTime($paymentHistory->salary->salaryTo); echo date_format($date, 'd M Y'); ?> </td>
                <td class="text-center"> <?php $date = new DateTime($paymentHistory->salary->salaryFrom); echo date_format($date, 'd M Y'); ?></td>
                <td class="text-center"> {{ number_format($paymentHistory->amount) }} </td>
                <td class="text-center">Payed</td>
                <td class="no-padding-left"></td>
            </tr>
            @endforeach
		</tbody>
	</table>
</div>
<!-- /Payment History -->

@endsection