<?php

namespace App\Http\Controllers;


use Faker\Provider\Lorem;

class NewsController extends Controller
{
    private $categories = [
        [
            'title' => 'Спорт',
            'category' => 'sport'
        ], [
            'title' => 'Политика',
            'category' =>  'politics'
        ], [
            'title' => 'Наука и технологии‎',
            'category' =>  'politics'
        ], [
            'title' => 'Культура‎ ',
            'category' =>  'politics'
        ], [
            'title' => 'Экономика‎ ',
            'category' =>  'politics'
        ], [
            'title' => 'Религия‎',
            'category' =>  'politics'
        ]

    ];
    private $news = [
        [
            'id' => 1,
            'category' => 'sport',
            'title' => 'Новость 1',
            'text' => 'Текст первой новости про спорт',
        ], [
            'id' => 2,
            'category' => 'sport',
            'title' => 'Новость 2',
            'text' => 'Текст второй новости про спорт',
        ], [
            'id' => 3,
            'category' => 'politics',
            'title' => 'Новость 3',
            'text' => 'Текст третей новости про политику',
        ], [
            'id' => 4,
            'category' => 'politics',
            'title' => 'Новость 4',
            'text' => 'Текст четвёртой новости про политику',
        ],
    ];

    public function categoriesNews()
    {
        $title = 'Категории новостей';
        return view('news.newsCategories')->with([
            'title' => $title,
            'categories' => $this->categories,
            'news' => $this->news,
        ]);
    }

    public function showCategory($category)
    {
        $title = "Новости в категории $category";
        $newsByCategory = [];
        foreach ($this->news as $new) {
            if ($new['category'] == $category) {
                $newsByCategory[] = $new;
            }
         }

        return view('news.news')->with([
            'title' => $title,
            'news' => $newsByCategory,
            'categories' => $this->categories,
        ]);
    }

    public function oneNews($id)
    {
        foreach ($this->news as $new) {
            if ($new['id'] == $id) {
                return view('news.newsOne')->with([
                    'title' => $new['title'],
                    'new' => $new,
                    'categories' => $this->categories,
                ]);
            }
        }
        redirect(route('news.all'));
    }

    public function allNews()
    {
        $title = 'Все новости';
        return view('news.news')->with([
            'title' => $title,
            'news' => $this->news,
            'categories' => $this->categories,
        ]);

        //        return view('news', compact('title', 'news'));

    }
}
