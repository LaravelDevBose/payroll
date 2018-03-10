@extends('backEnd.master')

@section('title')

Payment System-Update

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
                    <h5 class="panel-title">Payment System Edit Form</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">

                    <form  method="POST" action="{{ route('paymentSystem.update') }}" name="editPaymentForm">
                        {{ csrf_field() }}
                        <input type="hidden"  name="paymentId" value="{{ $paymentSystemById->id }}" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Title: <span class="text-danger">*</span></label>
                                    <input type="text" name="paymentTitle" class="form-control required" value="{{ $paymentSystemById->paymentTitle }}" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ammount: <span class="text-danger">*</span> (.Tk) </label>
                                    <input type="text" name="amount" class="form-control required " value="{{ $paymentSystemById->amount }}" >
                                    <p class="text text-info"> This Field Ammount Will Use For Per day/week/mounth Payment !</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Over Time Ammount: <span class="text-danger">*</span> </label>
                                    <input type="text" name="overTimeAmmount" class="form-control required " value="{{ $paymentSystemById->overTimeAmmount }}" >
                                    <p class="text text-info">Over Time Ammount Will Count For Per Hour Work !</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Publicatiopn Status: <span class="text-danger">*</span></label>
                                    <select class="select" name="publicationStatus" value="{{ old('publicationStatus') }}" required autofocus >
                                        <optgroup label="Select Publication Type">
                                            <option value="1">Publish </option>
                                            <option value="0">UnPublish</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-block btn-primary">Update Payment System Information <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>

        <!-- /basic layout -->

    </div>
</div>

<!-- //Depertment Information Insert -->
  <script>
    document.forms['editPaymentForm'].elements['publicationStatus'].value={{ $paymentSystemById->publicationStatus }}
</script>


@endsection
