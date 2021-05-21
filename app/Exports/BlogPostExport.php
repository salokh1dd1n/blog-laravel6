<?php

namespace App\Exports;

use App\Models\BlogPost;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BlogPostExport implements FromView
{
    /**
     * @return \Illuminate\View\View
     */
    public function view(): View
    {
        $items = BlogPost::all();
        return view('blog.admin.posts.includes.posts_table', compact('items'));
    }
}
