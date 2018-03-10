@extends('backEnd.master')

@section('title')
Worker-Update
@endsection

@section('assetlink')

<!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/wizards/stepy.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/validation/validate.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/pages/wizard_stepy.js')}}"></script>

    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/uploaders/fileinput/plugins/purify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('public/backEnd/js/pages/uploader_bootstrap.js') }}"></script>

<!-- /theme JS files -->

@endsection

@section('content')

<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title text-semibold text-orange">{{ $workerById->name }}'s Information Edit Form</h6>
        
    </div>

   @include('backEnd.includes.massageContent')
    

    <form class="stepy-validation" action="{{ route('worker.update')}}" method="POST" name="workerEditForm" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset title="1">
            <legend class="text-semibold">Personal Information</legend>
            <input type="hidden" name="workerEditId" value="{{ $id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Worker name: <span class="text-danger text-bold">*</span></label>
                        <input type="text" name="name" value="{{ $workerById->name }}" class="form-control required" placeholder="worker Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>National Id: <span class="text-danger text-bold">*</span> </label>
                        <input type="number" name="nationalId" value="{{ $workerById->nationalId }}" class="form-control required " placeholder="National Id Number">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone #: <span class="text-danger text-bold">*</span></label>
                        <input type="text" name="phoneNo" value="{{ $workerById->phoneNo }}" class="form-control required" placeholder="+880-99-99-999-999" data-mask="+880-99-99-999-999">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email address: </label>
                        <input type="email" name="email" value="{{ $workerById->email }}" class="form-control " placeholder="your@email.com">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label>Gender: <span class="text-danger text-bold">*</span></label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="1" class="styled" {{ ($workerById->gender == 1) ? 'checked' : ' '}} >
                            Male
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="gender" value="0" class="styled" {{ ($workerById->gender == 0) ? 'checked' : ' '}}>
                            Female
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                <img src="{{ asset($workerById->image ) }}" height="100" width="150">
                    <div class="form-group">
                        <label class="col-lg-2 control-label text-semibold">Image: <span class="text-danger text-bold">*</span></label>
                        <div class="col-lg-10">
                            <input type="file" name="image" class="file-input " data-browse-class="btn btn-primary btn-block" accept="image/*" data-show-remove="false" data-show-caption="false" data-show-upload="false">
                            <span class="help-block">max. image size 1.5MB.</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </fieldset>

        <fieldset title="2">
            <legend class="text-semibold">Address Information</legend>
            <div>
            <h6 class="panel-title alert">Present Address Information</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>House No:</label>
                            <input type="text" name="preHouseNo" value="{{ $workerById->preHouseNo }}" class="form-control " placeholder="House No.">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Road No: </label>
                            <input type="text" name="preRoadNo" value="{{ $workerById->preRoadNo }}" class="form-control " placeholder="Road No">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Village:  </label>
                            <input type="text" name="preVillage" value="{{ $workerById->preVillage }}" class="form-control  " placeholder="Village..">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Post Office: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="preP_O" value="{{ $workerById->preP_O }}" class="form-control required" placeholder="Post Office Name">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Police Station: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="preP_S" value="{{ $workerById->preP_S }}" class="form-control required" placeholder="Polish Station Name">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Postal Code: <span class="text-danger text-bold">*</span> </label>
                            <input type="number" name="preP_C" value="{{ $workerById->preP_C }}" class="form-control required " placeholder="Postal/ZIP Code ">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>District: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="preDistrict" value="{{ $workerById->preDistrict }}" class="form-control required" placeholder="District Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="preCountry" value="{{ $workerById->preCountry }}" class="form-control required" placeholder="Country Name">
                        </div>
                    </div>
                
                </div>
            </div>
            <div>
            <h6 class="panel-title alert">Parmanent Address Information</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>House No:</label>
                            <input type="text" name="parHouseNo" value="{{ $workerById->parHouseNo }}" class="form-control" placeholder="House No.">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Road No:</label>
                            <input type="text" name="parRoadNo" value="{{ $workerById->parRoadNo }}" class="form-control " placeholder="Road No.">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Village: </label>
                            <input type="text" name="parVillage" value="{{ $workerById->parVillage }}" class="form-control  " placeholder="Vilalge">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Post Office: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="parP_O" value="{{ $workerById->parP_O }}" class="form-control required" placeholder="Post Office Name">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Police Station: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="parP_S" value="{{ $workerById->parP_S }}" class="form-control required" placeholder="Police Station Name">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Postal Code: <span class="text-danger text-bold">*</span> </label>
                            <input type="number" name="parP_C" value="{{ $workerById->parP_C }}" class="form-control required " placeholder="Postal/ZIP Code">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>District: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="parDistrict" value="{{ $workerById->parDistrict }}" class="form-control required" placeholder="District Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country: <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="parCountry" value="{{ $workerById->parCountry }}" class="form-control required" placeholder="Country Name">
                        </div>
                    </div>
                
                </div>
            </div>

        </fieldset>

        <fieldset title="3">
            <legend class="text-semibold">Depertment & Payment  </legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Select Depertment: <span class="text-danger text-bold">*</span></label>
                        <select name="depertmentId" data-placeholder="Select Depertment" class="select required">
                            <option></option>
                            @foreach( $depertments as $depertment )
                                <option value="{{ $depertment->id }}">{{ $depertment->deptName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Select Payment Type: <span class="text-danger text-bold">*</span></label>
                        <select name="paymentType" data-placeholder="Select Payment System" class="select required">
                            @foreach( $paymentSystems as $paymentSystem )
                                <option value="{{ $paymentSystem->id }}">{{ $paymentSystem->paymentTitle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Salary/Wages Amount: (Tk.) <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="ammount" value="{{ $workerById->amount }}" class="form-control required" placeholder="John Doe">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Min Working Time: (Hours) <span class="text-danger text-bold">*</span></label>
                            <input type="text" name="timeLimit" value="{{ $workerById->timeLimit }}" class="form-control required" placeholder="John Doe">
                        </div>
                    </div>
                
                </div>
        </fieldset>

        

        <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
    </form>
</div>

<script>
    document.forms['workerEditForm'].elements['depertmentId'].value={{ $workerById->depertmentId }}
    document.forms['workerEditForm'].elements['paymentType'].value={{ $workerById->paymentType }}
</script>

@endsection