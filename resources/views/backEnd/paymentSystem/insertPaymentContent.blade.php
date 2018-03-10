@extends('backEnd.master')

@section('title')
Payment System
@endsection

@section('assetlink')

<!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/styling/uniform.min.js')}}"></script>

    
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/uploaders/fileinput/plugins/purify.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/uploaders/fileinput/plugins/sortable.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/uploaders/fileinput/fileinput.min.js')}}"></script>
    
    <script type="text/javascript" src="{{ asset('public/backEnd/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/pages/form_layouts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/pages/uploader_bootstrap.js')}}"></script>
<!-- /theme JS files -->

@endsection

@section('content')

@include('backEnd.includes.massageContent')

@if(in_array(7,$admin_roles))
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Payment Information Insert Form</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <form  method="POST" action="{{ route('paymentSystem.store') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Payment Title: <span class="text-danger text-bold">*</span></label>
                                <input type="text" name="paymentTitle" class="form-control required" value="{{ old('paymentTitle') }}" required placeholder="Payment Title">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Time Duration: <span class="text-danger text-bold">*</span></label>
                                <input type="number" name="duration" class="form-control required " value="{{ old('duration') }}" required placeholder="Enter The Duration of Working Time">
                                <p class="text text-info"> Enter The Deuration of Working Time</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>The Unit: <span class="text-danger text-bold">*</span></label>
                                <select class="select" name="unit" value="{{ old('unit') }}" required autofocus >
                                    
                                        <option value="1">Hour </option>
                                        <option value="2">Day</option>
                                        <option value="3">Month</option>
                                    
                                </select>
                                <p class="text text-info">Select The working Time Duration Unit !</p>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Publicatiopn Status: <span class="text-danger text-bold">*</span></label>
                                <select class="select" name="status" value="{{ old('status') }}" required autofocus >
                                    <optgroup label="Select Publication Type">
                                        <option value="1">Publish </option>
                                        <option value="0">Unpublish</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>.</label>
                                <button type="submit" class="btn btn-block btn-success">Save <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                            
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

    </div>
</div>

@endif
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Payment Information Table</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                
            </ul>
        </div>
    </div>

<!--     <div class="panel-body">
        Highlighting rows and columns have be quite useful for drawing attention to where the user's cursor is in a table, particularly if you have a lot of narrow columns. Of course the highlighting of a row is easy enough using CSS, but for column highlighting, you need to use a little bit of Javascript. This example shows that in action on DataTable by making use of the <code>cell().index()</code>, <code>cells().nodes()</code> and <code>column().nodes()</code> methods.
    </div> -->

    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Payment Title</th>
                <th>Duration</th>
                <th>Time Unit</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
    @if(!count($paymentsInfo)==0)
        <?php $i=1; ?>
        @foreach($paymentsInfo as $paymentInfo)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $paymentInfo->paymentTitle }}</td>
                <td>{{ $paymentInfo->duration }}</td>
                <td>
                    @if($paymentInfo->unit == 1)
                        <span class="label text-purple">Hour</span>

                    @elseif($paymentInfo->unit == 2)
                        <span class="label text-teal">Day</span>

                    @elseif($paymentInfo->unit == 3)
                        <span class="label text-orange-800">Month</span>
                    @endif
                </td>
                <td>
                    @if($paymentInfo->status == 1)
                        <span class="label label-success">Publich</span>
                    @else
                        <span class="label label-danger">UnPublish</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($paymentInfo->id > 3)
                        <a @if(in_array(8,$admin_roles)) href="{{ route('paymentSystem.edit',$paymentInfo->id) }}" class="btn btn-sm btn-primary "  @else class="btn btn-sm btn-primary noty-runner" data-layout="top" data-type="warning" @endif ><i class="icon-pencil7"></i> Edit</a>
                        <a @if(in_array(9,$admin_roles)) href="{{ route('paymentSystem.delete',$paymentInfo->id) }}" class="btn btn-sm btn-danger " @else class="btn btn-sm btn-danger noty-runner" data-layout="top" data-type="warning" @endif ><i class="icon-bin"></i>Delete</a>
                    @endif
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6"> 
                <p class="alert alert-info text-center"> No Payment System Information Insert. <br> Please Insert Payment Type Information ..! </p>
            </td>
        </tr>
    @endif
            
        </tbody>
        <tfoot>
            <tr>
                <th>Sl No.</th>
                <th>Payment Title</th>
                <th>Ammount</th>
                <th>Over Time Ammount</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </tfoot>
    </table>
</div>

<!-- //Depertment Information show -->


@endsection
