<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCatergoryRepository;

class CategoryController extends BaseController
{

    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCatergoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $items = BlogCategory::paginate(15);
        $items = $this->blogCategoryRepository->getAllWithPaginate(15);
        return view('blog.admin.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @return \Illuminate\Database\Eloquent\Builder make() */
        $item = BlogCategory::make();
//        $categoryList = BlogCategory::all();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return  view('blog.admin.categories.edit',
                compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = \Str::slug($data['title']);
        }
//        $item = new BlogCategory($data);
//        $item->save();
        $item = BlogCategory::create($data);
        if($item){
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else{
            return back()
                ->withErrors(['msg' => "Ощибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param BlogCatergoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();
        $item = $this->blogCategoryRepository->getEdit($id);

        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return  view('blog.admin.categories.edit',
                compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id){
//        $rules = [
//            'title' => 'required|min:5|max:200',
//            'slug' => 'max:200',
//            'description' => 'string|max:500|min:3',
//            'parent_id' => 'required|integer|exists:blog_categories,id',
//        ];
//
//        $validatedData = $this->validate($request, $rules);
//
//        dd($validatedData);
        $item = $this->blogCategoryRepository->getEdit($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдено"])
                ->withInput();
        }
        $data = $request->all();
        if(empty($data['slug'])){
            $data['slug'] = \Str::slug($data['title']);
        }
        $result = $item->update($data);
//            ->fill($data)
//            ->save();
        if($result){
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else{
            return back()
                ->withErrors(['msg' => "Ощибка сохранения"])
                ->withInput();
        }
    }


}
