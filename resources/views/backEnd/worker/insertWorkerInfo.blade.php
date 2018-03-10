@extends('backEnd.master')

@section('title')
Worker-Insert
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
        <h6 class="panel-title">Worker Registaion Form</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

   @include('backEnd.includes.massageContent')
    

    <form class="stepy-validation" action="{{ route('worker.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset title="1">
            <legend class="text-semibold">Personal Information</legend>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Applicant name: <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control required" placeholder="worker Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>National Id: <span class="text-danger">*</span> </label>
                        <input type="number" name="nationalId" class="form-control required " placeholder="National Id Number">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone #: <span class="text-danger">*</span></label>
                        <input type="text" name="phoneNo" class="form-control required" placeholder="+880-99-99-999-999" data-mask="+880-99-99-999-999">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email address: </label>
                        <input type="email" name="email" class="form-control " placeholder="your@email.com">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label>Gender: <span class="text-danger">*</span></label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="1" class="styled" checked="checked">
                            Male
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="gender" value="0" class="styled">
                            Female
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-lg-2 control-label text-semibold">Image: <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="file" name="image" class="file-input required" data-browse-class="btn btn-primary btn-block" accept="image/*" data-show-remove="false" data-show-caption="false" data-show-upload="false">
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
                            <input type="text" name="preHouseNo" class="form-control " placeholder="House No.">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Road No: </label>
                            <input type="text" name="preRoadNo" class="form-control " placeholder="Road No">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Village:  </label>
                            <input type="text" name="preVillage" class="form-control  " placeholder="Village..">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Post Office: <span class="text-danger">*</span></label>
                            <input type="text" name="preP_O" class="form-control required" placeholder="Post Office Name">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Police Station: <span class="text-danger">*</span></label>
                            <input type="text" name="preP_S" class="form-control required" placeholder="Polish Station Name">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Postal Code: <span class="text-danger">*</span> </label>
                            <input type="number" name="preP_C" class="form-control required " placeholder="Postal/ZIP Code ">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>District: <span class="text-danger">*</span></label>
                            <input type="text" name="preDistrict" class="form-control required" placeholder="District Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country: <span class="text-danger">*</span></label>
                            <input type="text" name="preCountry" class="form-control required" placeholder="Country Name">
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
                            <input type="text" name="parHouseNo" class="form-control" placeholder="House No.">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Road No:</label>
                            <input type="text" name="parRoadNo" class="form-control " placeholder="Road No.">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Village: </label>
                            <input type="text" name="parVillage" class="form-control  " placeholder="Vilalge">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Post Office: <span class="text-danger">*</span></label>
                            <input type="text" name="parP_O" class="form-control required" placeholder="Post Office Name">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Police Station: <span class="text-danger">*</span></label>
                            <input type="text" name="parP_S" class="form-control required" placeholder="Police Station Name">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Postal Code: <span class="text-danger">*</span> </label>
                            <input type="number" name="parP_C" class="form-control required " placeholder="Postal/ZIP Code">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>District: <span class="text-danger">*</span></label>
                            <input type="text" name="parDistrict" class="form-control required" placeholder="District Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country: <span class="text-danger">*</span></label>
                            <input type="text" name="parCountry" class="form-control required" placeholder="Country Name">
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
                        <label>Select Depertment: <span class="text-danger">*</span></label>
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
                        <label>Select Payment Type: <span class="text-danger">*</span></label>
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
                            <label>Ammount: <span class="text-danger">*</span></label>
                            <input type="text" name="ammount" class="form-control required" placeholder="John Doe">.Tk
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Working Time: <span class="text-danger">*</span></label>
                            <input type="text" name="timeLimit" class="form-control required" placeholder="John Doe">
                        </div>
                    </div>
                
                </div>
        </fieldset>

        <!-- <fieldset title="4">
            <legend class="text-semibold">Finger Print Information</legend>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="display-block">Applicant resume:</label>
                        <input type="file" name="resume" class="file-styled">
                        <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Where did you find us? <span class="text-danger">*</span></label>
                        <select name="source" data-placeholder="Choose an option..." class="select-simple required">
                            <option></option> 
                            <option value="monster">Monster.com</option> 
                            <option value="linkedin">LinkedIn</option> 
                            <option value="google">Google</option> 
                            <option value="adwords">Google AdWords</option> 
                            <option value="other">Other source</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Availability: <span class="text-danger">*</span></label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="availability" class="styled required">
                                Immediately
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="availability" class="styled">
                                1 - 2 weeks
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="availability" class="styled">
                                3 - 4 weeks
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="availability" class="styled">
                                More than 1 month
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Additional information:</label>
                        <textarea name="additional-info" rows="5" cols="5" placeholder="If you want to add any info, do it here." class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </fieldset> -->

        <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
    </form>
</div>

@endsection