@if($errors->any())
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-danger" role="alert">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">x</span>
                </button>
                <ul>
                    @foreach($errors->all() as $errorTxt)
                        <li>{{ $errorTxt }}</li>
                    @endforeach
                </ul>
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

@if(session('delete') and session('key'))
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-success" role="alert">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">x</span>
                </button>
                <div class="row">
                    <div class="col-md-6">{{ session()->get('delete') }}</div>
                    <div class="col-md-6">
                        <form action="{{ route('blog.admin.posts.restore', session()->get('key')) }}">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Востановить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
