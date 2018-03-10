@extends('backEnd.master')

@section('title')
Admin-DashBoard
@endsection

@section('assetlink')

    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/visualization/echarts/echarts.js')}}"></script>

    <script type="text/javascript" src="{{ asset('public/backEnd/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/pages/ecommerce_customers.js')}}"></script>
    <style > .c_width{ width: 5px !important; } </style>
@endsection

@section('content')

@include('backEnd.includes.massageContent')
<div class="row">
    <div class="col-lg-12">
        @if(in_array(13, $admin_roles))
            <!-- /Today Attendence Worker Salary and Wages Payment Info show -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Worker Salary Info</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                                <li><a href="{{ route('salarys') }}" class="btn btn-sm btn-info text-semibold text-white">All</a></li>

                            @forelse($paymentTypes as $paymentType)
                                <li><a href="{{ route('salarys.types',$paymentType->id) }}" class="btn btn-sm btn-info text-semibold text-white">{{ ucfirst($paymentType->paymentTitle) }}</a></li>
                            @empty

                            @endforelse
                            <li><a data-action="reload"></a></li>
                            
                            
                        </ul>
                    </div>
                </div>
                <hr>
                <table class="table table-striped text-nowrap table-customers">
                    <thead>
                        <tr>
                            <th class="c_width">SL.No.</th>
                            <th>Name</th>
                            <th>Duration</th>
                            <th>Payment Type</th>
                            <th>T.Present</th>
                            <th>Overtime</th>
                            <th>O.T. Payment</th>
                            <th>T. Payment</th>
                            <th>Payable</th>
                            <th>Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach( $salaryAndWages as $salaryAndWage )
                        <tr class="yes">
                            <td id="{{ $salaryAndWage->workerId }}"> {{ $loop->iteration }} </td>
                            <td>
                                <div class="media">
                                    <div class="media-body media-middle">
                                        <a href="{{ route('profile',$salaryAndWage->workerId) }}" class="text-semibold"> {{ $salaryAndWage->worker->name }} </a>
                                        <div class="text-muted text-size-small">
                                            {{ $salaryAndWage->worker->workerViewId }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php $date = new DateTime($salaryAndWage->salaryTo); echo date_format($date, 'd').' - ';  $date = new DateTime($salaryAndWage->salaryFrom); echo date_format($date, 'd M Y'); ?>   </td>
                            <td> {{ $salaryAndWage->paymentType->paymentTitle }} </td>
                            <td> {{ $salaryAndWage->present }} </td>
                            <td>{{ $salaryAndWage->overtime }} Hours</td>
                            <td> {{ number_format($salaryAndWage->overtimeSalary) }} </td>
                            <td id="{{ $salaryAndWage->totalSalary }}"> {{ number_format($salaryAndWage->totalSalary) }} </td>
                            <td id="{{ $salaryAndWage->totalSalary - $salaryAndWage->paymentHistory->sum('amount') }}"> {{ number_format($salaryAndWage->totalSalary - $salaryAndWage->paymentHistory->sum('amount')) }} </td>
                            <td class="text-right">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu7"></i>
                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('profile',$salaryAndWage->workerId) }}"><i class="icon-file-eye2"></i>Profile View</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('payment.history',$salaryAndWage->workerId) }}"><i class="icon-file-eye2"></i>View Payment History</a></li>
                                            <li class="divider"></li>
                                            <li><button type="button" class="btn btn-info btn-block payment_view" id="{{ $salaryAndWage->id }}" data-toggle="modal" data-target="#payment_model"><i class="icon-cash4"></i>Pay Salary/wages</button></li>
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
            <!-- /worker details -->
            <div id="payment_model" class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title">Payment </h6>
                        </div>
                        <form action="{{ route('payment.store') }}" method="POST">{{ csrf_field() }}
                            <div class="modal-body">
                                <label class="msg text text-semibold text-danger text-nowrap"></label>
                                <h6 class="text-semibold workerName"></h6>
                                <div class="col-md-6">
                                    <p>Total Salary: <span class="totalSalary"></span> Tk.</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Payable: <span class="payAble"></span> Tk.</p>
                                </div>
                                

                                <hr>

                                <div class="form-group">
                                    
                                    <div class="row">
                                        <input type="hidden" name="workerId">
                                        <input type="hidden" name="salary_id">
                                        <div class="col-sm-6">
                                            <label>Payed Ammount <strong class="text-bold text-danger">*</strong> </label>
                                            <input type="number" name="amount"  id="payed_amount" placeholder="Payed Amount" required class="form-control">
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Payable Amount</label>
                                            <input type="text" id="payable"  placeholder="payable Amount" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success payment_store">Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                var totalSalary = 0;
                var payAble = 0;
                $('.payment_view').on('click', function(e){
                    
                    var salary_id = $(this).attr('id');
                    var workerIdw = $(this).parents('tr').attr('class');

                    var workerId = $(this).parents('tr').find('td:first-child').attr('id');
                    var workerName = $(this).parents('tr').find('td:nth-child(2)').find('a').text();
                    var viewSalary = $(this).parents('tr').find('td:nth-child(8)').text();
                    totalSalary = $(this).parents('tr').find('td:nth-child(8)').attr('id');
                    var viewPayable = $(this).parents('tr').find('td:nth-child(9)').text();
                    payAble = $(this).parents('tr').find('td:nth-child(9)').attr('id');
                    

                    $('#payment_model').find('.workerName').text(workerName);
                    $('#payment_model').find('.totalSalary').text(viewSalary);
                    $('#payment_model').find('.payAble').text(viewPayable);
                    $('#payment_model').find('input[name="workerId"]').val(workerId);
                    $('#payment_model').find('input[name="salary_id"]').val(salary_id);
                    $('#payment_model').find('input[name="workerId"]').val(workerId);
                });

                $('#payed_amount').on('input', function(e){
                    var payed_amount = e.target.value;

                    if(parseInt(payAble) >= payed_amount){

                        $('#payment_model').find('.msg').text(' ');
                        $('#payment_model').find('.payment_store').attr('type', 'submit');
                        var payable = parseInt(payAble) - payed_amount;
                        $('#payment_model').find('input[id="payable"]').val(payable);
                    }else{
                        var msg = 'Payment Amount is not more than Total Salary Amount..!';
                        $('#payment_model').find('.msg').text(msg);
                        $('#payment_model').find('.payment_store').attr('type', 'button');
                    }
                    
                });
            </script>

            <!-- //worker salary and wages payment information  -->
        @endif

        <!-- /FringerPrint not Insert Worker Information show -->
        @if(!count($fringerPrintNullInfos)==0 || !is_null($fringerPrintNullInfos)|| !empty($fringerPrintNullInfos))
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-teal">Show New Worker Information</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        {{--<li><a data-action="close"></a></li>--}}
                    </ul>
                </div>
            </div>
            <table class="table table-bordered table-hover datatable-highlight">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Avater</th>
                        <th>Worker Name</th>
                        <th>Worker Id</th>
                        <th>Depertment Name</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php $i=1; ?>
                @foreach($fringerPrintNullInfos as $workerInfo)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td><img src="{{ asset($workerInfo->image) }}" height="40" width="40" class="img-circle"> </td>
                        <td>{{ $workerInfo->name }}</td>
                        <td><label>{{ $workerInfo->workerViewId }}</label></td>
                        <td>{{ $workerInfo->deptName }}</td>
                        <td><span class="label label-success">Not Insert</span></td>
                        <td class="text-center">
                            <a href="{{ url('singel/worker/profile/'.$workerInfo->id ) }}" class="btn btn-sm btn-info " title="View Profile"><i class="icon-eye"></i> View Profile</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Avater</th>
                        <th>Worker Name</th>
                        <th>Worker Id</th>
                        <th>Depertment Name</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </tfoot>
            </table>
            {{ $fringerPrintNullInfos->links() }}
        </div>
        <!-- //FringerPrint not Insert Worker Information show  -->
        @endif
    </div>
</div>
<!-- /main charts -->




@endsection
