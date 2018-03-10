@extends('backEnd.master')

@section('title')
Depertment

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

@if(in_array(4,$admin_roles))
<div class="row">
    <div class="col-md-12">
        <!-- /Depertment Information Insert -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Department Insert Form</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        
                        <li><a data-action="reload"></a></li>
                        
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <form  method="POST" action="{{ route('depertment.store') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Department Name: <span class="text-danger">*</span></label>
                                <input type="text" name="deptName" class="form-control required" value="{{ old('deptName') }}" placeholder="Depertment Name..">
                                <p class="text text-info text-small" >This Depertment Name That will Show</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Depertment Code: <span class="text-danger">*</span> </label>
                                <input type="text" name="deptCode" class="form-control required " value="{{ old('deptCode') }}" placeholder="Depertment Code (Upper Case)">
                                <p class="text text-info text-small" >This Depertment Code </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Working Time: <span class="text-danger">*</span> </label>
                                <input type="number" name="workingTime" class="form-control required " value="{{ old('workingTime') }}" placeholder="One Day Working Time">
                                <p class="text text-info text-small" >This Depertment Worker Minmum Working Time</p>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Publicatiopn Status: <span class="text-danger">*</span></label>
                                <select class="select" name="publicationStatus" value="{{ old('publicationStatus') }}" required autofocus >
                                    <optgroup label="Select Publication Type">
                                        <option value="1">Public </option>
                                        <option value="0">UnPublic</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label style="color: #fff;">.</label>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-block btn-success">Save <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- //Depertment Information Insert -->
    </div>
</div>
@endif
<!-- /Depertment Information show -->

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Show Department Information</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                
                <li><a data-action="reload"></a></li>
                
            </ul>
        </div>
    </div>

    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Department Name</th>
                <th>Dept. Code</th>
                <th>Working Time</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        @if(!count($depertments)==0)
        <?php $i=1; ?>
            @foreach($depertments as $depertment)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $depertment->deptName }}</td>
                    <td>{{ $depertment->deptCode }}</td>
                    <td>{{ $depertment->workingTime }}</td>
                    <td>
                        @if($depertment->publicationStatus == 1)
                            <span class="label label-success">Publich</span>
                        @else
                            <span class="label label-danger">UnPublish</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a @if(in_array(5,$admin_roles)) href="{{ url('/depertment/edit/'.$depertment->id) }}" class="btn btn-sm btn-primary" @else class="btn btn-sm btn-primary  noty-runner" data-layout="top" data-type="warning" @endif><i class="icon-pencil7"></i> Edit</a>
                        <a @if(in_array(6,$admin_roles)) href="{{ url('/depertment/delete/'.$depertment->id) }}" class="btn btn-sm btn-danger" @else class="btn btn-sm btn-danger  noty-runner" data-layout="top" data-type="warning" @endif><i class="icon-bin"></i>Delete</a>
                    </td>
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="6"> 
                <p class="alert alert-info text-center"> No Department Information Insert. <br> Please Insert Department Information ..! </p>
            </td>
        </tr>
        @endif
        </tbody>
        <tfoot>
            <tr>
                <th>Sl No.</th>
                <th>Department Name</th>
                <th>Dept. Code</th>
                <th>Working Time</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </tfoot>
    </table>
</div>

<!-- //Depertment Information show -->


@endsection
