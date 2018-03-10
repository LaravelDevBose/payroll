<div class="row">
    <div class="col-md-12">
        @if(Session::get('success'))
        <div class="alert bg-success alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Well done!</span> {!! Session::get('success') !!}
        </div>
        @endif

        @if(Session::get('unsuccess'))
        <div class="alert bg-danger alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Oh snap!</span> {!! Session::get('unsuccess') !!}
        </div>
        @endif

        @if(Session::get('warning'))
            <div class="alert alert-warning alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Warning!</span> {!! Session::get('warning') !!}
            </div>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Warning!</span> {!! $error !!}
                </div>
            @endforeach

        @endif
    </div>
</div>