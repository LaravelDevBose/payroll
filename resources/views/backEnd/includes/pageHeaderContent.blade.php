<div class="row" style="padding: 15px 15px 0 15px;">
    <div class="col-sm-3 col-md-3">
        <div class="panel panel-body bg-success-400 has-bg-image">
            <div class="media no-margin">
                <a href="{{ route('worker') }}" style="color: #fff;">
                    <div class="media-body"> 
                        <h3 class="no-margin">{{ $totalWorker }}</h3>
                        <span class="text-uppercase text-size-mini">Worker & Laber</span>
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-users4 icon-3x opacity-75"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-3 col-md-3">
        <div class="panel panel-body bg-blue-400  has-bg-image">
            <div class="media no-margin">
                <a href="{{ route('depertment') }}" style="color: #fff;">
                    <div class="media-body">
                        <h3 class="no-margin">{{ $totalDept }}</h3>
                        <span class="text-uppercase text-size-mini"> Departments</span>
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-hammer-wrench icon-3x opacity-75"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-3 col-md-3">
        <div class="panel panel-body bg-indigo-400 has-bg-image">
            <div class="media no-margin">
                <a href="{{ route('paymentSystem') }}" style="color: #fff;">
                    <div class="media-left media-middle">
                        <i class="icon-coins icon-3x opacity-75"></i>
                    </div>

                    <div class="media-body text-right">
                        <h3 class="no-margin">{{ $totalPaymentTypes }}</h3>
                        <span class="text-uppercase text-size-mini">Woker Types</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-3 col-md-3">
        <div class="panel panel-body bg-warning-600 has-bg-image">
            <div class="media no-margin">
                <a @if(in_array(16 ,$admin_roles)) href="{{ route('attendance.form')}}" @else class="noty-runner" data-layout="top" data-type="warning" @endif style="color: #fff;">
                    <div class="media-left media-middle">
                        <i class="icon-thumbs-up3 icon-3x opacity-75"></i>
                    </div>

                    <div class="media-body text-right">
                        <h3 class="no-margin">{{ date('d-M-Y') }}</h3>
                        <span class="text-uppercase text-size-mini">Insert Atandance</span>
                    </div>

                </a>
            </div>
        </div>
    </div>
    
</div>