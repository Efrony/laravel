<?php

namespace App\Http\Controllers;


use Faker\Provider\Lorem;

class NewsController extends Controller
{
    private $categories = [
        [
            'id' => 1,
            'title' => 'Спорт',
            'category' => 'sport'
        ], [
            'id' => 2,
            'title' => 'Политика',
            'category' =>  'politics'
        ], [
            'id' => 3,
            'title' => 'Наука и технологии',
            'category' =>  'politics'
        ], [
            'id' => 4,
            'title' => 'Культура',
            'category' =>  'politics'
        ], [
            'id' => 5,
            'title' => 'Экономика',
            'category' =>  'politics'
        ], [
            'id' => 6,
            'title' => 'Религия',
            'category' =>  'politics'
        ]

    ];
    private $news = [
        [
            'id' => 1,
            'category' => 1,
            'title' => 'Новость 1',
            'text' => 'Текст первой новости про спорт',
        ], [
            'id' => 2,
            'category' => 1,
            'title' => 'Новость 2',
            'text' => 'Текст второй новости про спорт',
        ], [
            'id' => 3,
            'category' => 1,
            'title' => 'Новость 3',
            'text' => 'Текст третей новости про политику',
        ], [
            'id' => 4,
            'category' => 2,
            'title' => 'Новость 4',
            'text' => 'Текст четвёртой новости про политику',
        ],
        [
            'id' => 5,
            'category' => 2,
            'title' => 'Новость 5',
            'text' => 'Текст пятой новости про политику',
        ],
        [
            'id' => 6,
            'category' => 2,
            'title' => 'Новость 6',
            'text' => 'Текст шестой новости про политику',
        ],
        [
            'id' => 7,
            'category' => 2,
            'title' => 'Новость 7',
            'text' => 'Текст седьмой новости про политику',
        ],
        [
            'id' => 8,
            'category' => 2,
            'title' => 'Новость 8',
            'text' => 'Текст восьмой новости про политику',
        ],
    ];


    public function showCategory($id)
    {
        foreach ($this->categories as $oneCategory) {
            if ($oneCategory['id'] == $id) {
                $category = $oneCategory;
                break;
            }
        }

        $title = 'Новости в категории ' . $category['title'];
        $newsByCategory = [];

        foreach ($this->news as $new) {
            if ($new['category'] == $category['id']) {
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
    }

    public function addNews()
    {
        $title = 'Добавить новость';
        return view('news.newsAdd')->with([
            'title' => $title,
            'categories' => $this->categories,
        ]);
    }

    //
//    public function categoriesNews()
//    {
//        $title = 'Категории новостей';
//        return view('news.newsCategories')->with([
//            'title' => $title,
//            'categories' => $this->categories,
//            'news' => $this->news,
//        ]);
//    }
}
