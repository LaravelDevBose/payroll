@extends('backEnd.master')

@section('title')
Depertment-Update
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

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
<!-- /Depertment Information Insert -->

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Depertment Edit Form</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">

                    <form  method="POST" action="{{ route('depertment.update') }}" name="editDeptForm">
                        {{ csrf_field() }}
                        <input type="hidden"  name="deptId" value="{{ $depertmentById->id }}" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Depertment Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="deptName" class="form-control required" value="{{ $depertmentById->deptName }}" placeholder="Depertment Name..">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Depertment Code: <span class="text-danger">*</span> </label>
                                    <input type="text" name="deptCode" class="form-control required " value="{{ $depertmentById->deptCode }}" placeholder="National Id Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Working Time: <span class="text-danger">*</span> </label>
                                    <input type="text" name="workingTime" class="form-control required " value="{{ $depertmentById->workingTime }}" placeholder="National Id Number">
                                    <p class="text text-info">This Field Will Use For At least how Much Time Need To Work For One Working Day Count</p>
                                </div>
                            </div>

                            <div class="col-md-6">
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
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-block btn-primary">Update Depertment Information <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>

        <!-- /basic layout -->

    </div>
</div>

<!-- //Depertment Information Insert -->
  <script>
    document.forms['editDeptForm'].elements['salerySystem'].value={{ $depertmentById->salerySystem }}
    document.forms['editDeptForm'].elements['publicationStatus'].value={{ $depertmentById->publicationStatus }}
</script>


@endsection
