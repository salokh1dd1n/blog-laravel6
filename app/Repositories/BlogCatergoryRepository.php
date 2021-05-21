<?php


namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;


class BlogCatergoryRepository extends CoreRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {

        $columns = implode(', ' , [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

//        $result[] = $this->startConditions()->all();
//
//        $result = $this
//            ->startConditions()
//            ->select('blog_categories.*', \DB::raw('CONCAT (id, ". ", title) AS id_title'))
//            ->toBase()
//            ->get();

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;
    }

    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([
                'parentCategory:id,title',
            ])
            ->paginate($perPage);
        return $result;
    }

}