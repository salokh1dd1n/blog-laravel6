<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();
//        dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        $collection = collect($eloquentCollection->toArray());
//        dd(
//            get_class($eloquentCollection),
//            get_class($collection),
//            $collection
//        );
//        $result['first'] = $collection->first();
//        $result['last'] = $collection->last();
//        dd($result);

//        $result['where']['data'] = $collection
//            ->where('category_id', 10)
//            ->values()
//            ->keyBy('id');
//
//        $result['where']['count'] = $result['where']['data']->count();
//        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
//        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

//        dd($result);

//        $result['where_first'] = $collection
//            ->firstWhere('created_at', '>', '2020-03-09 11:50:35');
        // Similar queries
//            ->where('created_at', '>', '2020-03-09 11:50:35')->first();


//        $result['map']['all'] = $collection->map(function ($item){
////            dd($item);
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//
//            return $newItem;
//        });

//        $result['map']['not_exists'] = $result['map']['all']
//            ->where('exists', false)
        // Equally, Identically (Одинаково, Идентично)
//            ->where('exists', NULL)
//            ->keyBy('item_id');
        // Базовая переменная (Коллекция) изменится (трансформируется)
//        $collection->transform(function ($item) {
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//            $newItem->created_at = Carbon::parse($item['created_at']);
//
//            return $newItem;
//        });

//        dd($collection);

//        $newItem = new \stdClass();
//        $newItem->id = 9999;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 8888;

//        dd($newItem, $newItem2);
//      prepend = Метод добавляет элемент в начало коллекции:
//        $collection->prepend($newItem);
//      push = Метод добавляет элемент в конец коллекции:
//        $collection->push($newItem2);
//        dd($newItem, $newItem2, $collection);

//        $newItemFirst = $collection->prepend($newItem)->first();
//        $newItemLast = $collection->push($newItem2)->last();
//      pull = Метод удаляет и возвращает элемент из коллекции по ключу:
//        $pulledItem = $collection->pull(10);
//        dd(compact('collection', 'newItemFirst', 'newItemLast', 'pulledItem'));

//        Фильтерация замена оrWhere

        $filtered = $collection->filter(function ($item){
           $byDay = $item['created_at']
           $byDate = $item->created_at->day == 13;

           $result = $byDay && $byDate;

           return $result;
        });
        dd(compact('filtered'));

//        Сортировка
        $sortedSimpleCollection = collect([5, 3, 2, 1, 4])->sort();
        $soretedAscCollection = $collection->sortBy('created_at');
        $soretedDescCollection = $collection->sortByDesc('item_id');

        dd(compact('sortedSimpleCollection', 'soretedAscCollection', 'soretedDescCollection'));
    }
}
