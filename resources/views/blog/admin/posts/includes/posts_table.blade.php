<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Автор</th>
        <th>Категория</th>
        <th>Заголовок</th>
        <th>Дата публикации</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $post)
        <tr @if(! $post->is_published) style="background-color: #ccc" @endif>
            <td>#{{ $post->id }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->category->title }}</td>
            <td>
                <a href="{{ route('blog.admin.posts.edit', $post->id) }}">
                    {{ $post->title }}
                </a>
            </td>
            <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot></tfoot>
</table>