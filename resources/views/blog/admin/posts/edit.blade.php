@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\BlogPost $item */
    @endphp

    <div class="container">
        @include('blog.admin.posts.includes.result_messages')

        @if($item->exists)
        <form method="POST" action="{{ route('blog.admin.posts.update', $item-> id) }}">
            @method('PATCH')
        @else
        <form method="POST" action="{{ route('blog.admin.posts.store') }}">
        @endif
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.posts.includes.item-edit-main-col')
                </div>
                <div class="col-md-4">
                    @include('blog.admin.posts.includes.item-edit-add-col')
                </div>
            </div>
        </form>
        @if($item->exists)
        <br>
        <form method="POST" action="{{ route('blog.admin.posts.destroy', $item-> id) }}">
            @method('DELETE')
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-block">
                        <div class="card-body ml-auto">
                            <button type="submit" class="btn btn-link">Удалить</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
        @endif
    </div>
@endsection
