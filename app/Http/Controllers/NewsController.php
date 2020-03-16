<?php

namespace App\Http\Controllers;


use App\Categories;
use App\News;

class NewsController extends Controller
{
    public function one(News $oneNews)
    {
        return view('news.newsOne', [
            'title' => $oneNews->title,
            'oneNews' => $oneNews,
            'categories' => Categories::all(),
        ]);
    }


    public function all()
    {
        return view('news.news', [
            'title' => 'Все новости',
            'news' => News::query()
                ->orderBy('id', 'desc')
                ->paginate(8),
            'categories' => Categories::all(),
        ]);
    }

    public function category(Categories $category)
    {
        return view('news.news', [
            'title' => 'Новости в категории ' . $category->title,
            'news' =>  $category->news()
                ->orderBy('id', 'desc')
                ->paginate(8),
            'categories' => Categories::all(),
        ]);
    }
}
