<?php

namespace App\Http\Controllers;


use App\Categories;
use App\News;

class NewsController extends DataController
{
    protected $fillable = ['title', 'category', 'text', 'image', 'private'];
    public function one(News $oneNews)
    {
        return view('news.newsOne', [
            'title' => $oneNews->title,
            'oneNews' => $oneNews,
            'categories' => $this->categories,
        ]);
    }


    public function all()
    {

        $title = 'Все новости';
        return view('news.news', [
            'title' => $title,
            'news' => News::paginate(8),
            'categories' => $this->categories,
        ]);
    }

    public function category(Categories $category)
    {
        $newsByCategory = News::where('category', $category->id)->paginate(8);

        return view('news.news', [
            'title' => 'Новости в категории ' . $category->title,
            'news' => $newsByCategory,
            'categories' => $this->categories,
        ]);
    }
}
