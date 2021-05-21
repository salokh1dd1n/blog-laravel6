@extends('layouts.app')

@section('content')
    <div class="container">
        @include('blog.admin.posts.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a href="{{ route('blog.admin.posts.create') }}" class="btn btn-primary">Написать новое сообщение</a>
                    <a href="{{ route('blog.admin.posts.export') }}" class="btn btn-success">Экспортировать все сообщения</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        @include('blog.admin.posts.includes.posts_table')
                    </div>
                </div>
            </div>
        </div>
            <br>
            <div class="row justify-contenet-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
