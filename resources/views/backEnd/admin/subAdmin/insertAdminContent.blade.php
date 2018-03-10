@extends('backEnd.master')

@section('title')
Admin-Register
@endsection

@section('assetlink')

<!-- Theme JS files -->
    {{-- input Type custom --}}
    
    <script type="text/javascript" src="{{ asset('public/backEnd /js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd /js/core/libraries/jasny_bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd /js/plugins/forms/styling/uniform.min.js') }}"></script>

    {{-- File Uplode --}}
    <script type="text/javascript" src="{{ asset('public/backEnd /js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd /js/pages/uploader_bootstrap.js') }}"></script>

    <script type="text/javascript" src="{{ asset('public/backEnd /js/plugins/forms/styling/switch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd /js/plugins/forms/styling/switchery.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('public/backEnd /js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd /js/pages/form_layouts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd /js/plugins/ui/ripple.min.js') }}"></script>

<!-- /theme JS files -->

@endsection

@section('content')


<div class="row">
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field()}}
        <!-- Profile info -->
        <div class="col-md-8">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Account And Profile Information</h6>
                    
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Username <span class="text-danger text-bold text-size-large">*</span></label>
                                <input type="text" name="username" placeholder=" Acount User Name" required class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Full name <span class="text-danger text-bold text-size-large">*</span></label>
                                <input type="text" name="name" placeholder="Full Name" required class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email <span class="text-danger text-bold text-size-large">*</span></label>
                                <input type="email" name="email" placeholder="Email Address" required class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Phone # <span class="text-danger text-bold text-size-large">*</span></label>
                                <input type="number" name="phone_number" placeholder="Phone Number" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label>Status <span class="text-danger text-bold text-size-large">*</span></label>
                                <select class="select" name="status" required>
                                    <option value="1" selected="selected">Active</option> 
                                    <option value="0">Block</option> 
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label >Image: <span class="text-danger text-bold text-size-large">*</span></label>
                                <input type="file" name="avater" class="file-input required" data-browse-class="btn btn-primary btn-block" accept="image/*" data-show-remove="false" data-show-caption="false" data-show-upload="false">
                                <span class="help-block text-semibold text-danger">max. image size 1.5MB.</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Password <span class="text-danger text-bold text-size-large">*</span></label>
                                <input type="password" name="password" placeholder="Enter Password" required class="form-control">
                                <span class="help-block text-semibold text-danger">Password Minmum 6 Character</span>
                            </div>
                            <div class="col-md-6">
                                <label>Confirm Password <span class="text-danger text-bold text-size-large">*</span></label>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control">
                                <span class="help-block text-semibold text-danger">Confirm Password Must Match with password</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /profile info -->

        <!-- Profile info -->
        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Role And Authority Information</h6>
                    
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group pt-15">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"  class="styled checkAll"   >
                                        Select All
                                    </label>
                                </div>

                                @foreach($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="role_id[]" value="{{ $role->id }}" class="styled" >
                                        {{ $role->role_name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
                
           <button type="submit" class="btn btn-success btn-block">Update Information <i class="icon-arrow-right14 position-right"></i></button>
                
        </div>
        <!-- /profile info -->
    </form>
</div>

<script>
    $(".checkAll").click(function () {

        if($('input:checkbox').eq(0).is(":checked")){
            $('input:checkbox').not(this).prop('checked', this.checked).parent().attr('class','checked');
        }else{
            $('input:checkbox').not(this).prop('checked', this.checked).parent().attr('class',' ');
        }
        
     });
    $('input:checkbox:not(.checkAll)').click(function(){

        if($('input:checkbox:checked').length == $('input:checkbox').length){

            $('.checkAll').parent().attr('class', 'checked');

        }else{
            
            $('.checkAll').parent().attr('class', ' ');
        }
        
    });
</script>

@endsection
