@if($errors->any())
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-danger" role="alert">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">x</span>
                </button>
                @foreach($errors->all() as $errorTxt)
                        <li>{{ $errorTxt }}</li>
                    @endforeach
            </div>
        </div>
    </div>
@endif
@if(session('success'))
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-success" role="alert">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">x</span>
                </button>
                {{ session()->get('success') }}
            </div>
        </div>
    </div>
@endif