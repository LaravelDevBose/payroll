@extends('backEnd.master')

@section('title')
{{ $adminById->name }}-Admin Information
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
    <script type="text/javascript" src="{{ asset('public/backEnd /js/pages/form_checkboxes_radios.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backEnd /js/plugins/ui/ripple.min.js') }}"></script>

<!-- /theme JS files -->

@endsection

@section('content')

@include('backEnd.includes.massageContent')


<div class="row">
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
                            <label>Username </label>
                            <input type="text" readonly value="{{ $adminById->username }}" placeholder=" Acount User Name" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Full name </label>
                            <input type="text" readonly  value="{{ $adminById->name }}"  placeholder="Full Name"  class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email </label>
                            <input type="email" readonly value="{{ $adminById->email }}" placeholder="Email Address"  class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Phone # </label>
                            <input type="number" readonly value="{{ $adminById->phone_number }}"  placeholder="Phone Number" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <label>Status </label>
                            <select class="select" disabled>
                                <option value="1"  {{ ($adminById->status == 1) ? 'selected' : ' ' }}>Active</option> 
                                <option value="0" {{ ($adminById->status == 0) ? 'selected' : ' ' }}>Block</option> 
                            </select>
                        </div>
                        <div class="col-md-6">
                            <?php $avater = $adminById->avater; if(!file_exists($avater)){ $avater = 'public/backEnd/images/placeholder.jpg';}?>
                            <img src="{{ asset($avater)}}" width="240" height="240"  alt="{{ $adminById->name }}">
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
                                    <input type="checkbox"  class="styled checkAll" disabled {{ (count($adminRoles) == 17 ) ? 'checked' : ' ' }} >
                                    Select All
                                </label>
                            </div>

                            @foreach($roles as $role)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"  value="{{ $role->id }}" name="role_id[]" disabled class="styled"  {{ (in_array($role->id, $adminRoles)) ? 'checked' : ' ' }} >
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

</div>


@endsection
