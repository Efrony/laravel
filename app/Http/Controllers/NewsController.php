<?php

namespace App\Http\Controllers;


use App\News;

class NewsController extends DataController
{

    public function showCategory($nameCategory)
    {
        $oneCategory = (new News())->getOneCategoryByName($nameCategory);
        $newsByCategory = [];

        foreach ($this->news as $new) {
            if ($new->category == $oneCategory->id) {
                $newsByCategory[] = $new;
            }
        }

        return view('news.news')->with([
            'title' => 'Новости в категории ' . $oneCategory->title,
            'news' => $newsByCategory,
            'categories' => $this->categories,
        ]);
    }


    public function oneNews($id)
    {
        $oneNews = (new News())->getOneNews($id);
        if (empty($oneNews)) {
            return redirect(route('news.all'));
        }

        return view('news.newsOne')->with([
            'title' => $oneNews->title,
            'oneNews' => $oneNews,
            'categories' => $this->categories,
        ]);
    }


    public function allNews()
    {
        $title = 'Все новости';
        return view('news.news')->with([
            'title' => $title,
            'news' => $this->news,
            'categories' => $this->categories,
        ]);
    }
}
