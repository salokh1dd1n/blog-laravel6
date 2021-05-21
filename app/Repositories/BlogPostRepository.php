<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;


class BlogPostRepository extends CoreRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate()
    {
        $columns = [
          'id',
          'title',
          'slug',
          'is_published',
          'published_at',
          'user_id',
          'category_id',
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
//            ->with(['category', 'user'])
            ->with([
//                'category' => function ($query){
//                    $query->select(['id', 'title']);
//                },
                'category:id,title',
                'user:id,name',

            ])
            ->paginate(25);
        return $result;

    }

}
