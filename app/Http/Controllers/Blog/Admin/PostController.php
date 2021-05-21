<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Exports\BlogPostExport;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCatergoryRepository;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class PostController
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends BaseController
{

    private $blogPostRepository;

    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCatergoryRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->blogPostRepository->getAllWithPaginate();
        return view('blog.admin.posts.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = BlogPost::make();
        $categoryList
            = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();
//        dd($data);
        $item = BlogPost::create($data);
        if($item){
            $job = new BlogPostAfterCreateJob($item);

            $this->dispatch($job);

            return redirect()
                ->route('blog.admin.posts.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else{
            return back()
                ->withErrors(['msg' => "Ощибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return  view('blog.admin.posts.edit',
                compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдено"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->update($data);

        if($result){
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else{
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  софт-удаление, в базе остается
        $result = BlogPost::destroy($id);
        //  полное удаления из БД
       //$result = BlogPost::find($id)->forceDelete();
        if($result){
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['delete' => "Запись id=[$id] удалена",
                        'key' => $id]);
        } else{
            return back()
                ->withErrors(['msg' => "Ошибка удаления"]);
        }
    }

    public function restore($id)
    {
        //  софт-удаление, в базе остается
        //$result = BlogPost::destroy($id);
        //  полное удаления из БД
       $result = BlogPost::withTrashed()->findOrFail($id)->restore();
        if($result){
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запись id=[$id] Восстановлено"]);
        } else{
            return back()
                ->withErrors(['msg' => "Ошибка Восстановлено"]);
        }
    }

    public function exportPosts()
    {
        $result = Excel::download(new BlogPostExport(), 'blogPosts.xlsx');
        return $result;
    }
}
