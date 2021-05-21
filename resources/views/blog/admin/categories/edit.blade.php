@extends('layouts.app')

@section('content')
    @if($item->exists)
        <form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}">
        @method('PATCH')
    @else
        <form method="POST" action="{{ route('blog.admin.categories.store') }}">
    @endif
        @csrf
        <div class="container">
            @include('blog.admin.categories.includes.result_messages')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.categories.includes.item-edit-main-col')
                </div>
                <div class="col-md-4">
                    @include('blog.admin.categories.includes.item-edit-add-col')
                </div>
            </div>
        </div>
    </form>
@endsection
