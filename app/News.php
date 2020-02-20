<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
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
            'category' =>  'science'
        ], [
            'id' => 4,
            'title' => 'Культура',
            'category' =>  'culture'
        ], [
            'id' => 5,
            'title' => 'Экономика',
            'category' =>  'economy'
        ], [
            'id' => 6,
            'title' => 'Религия',
            'category' =>  'religion'
        ]

    ];
    private $news = [
        [
            'id' => 1,
            'category' => 1,
            'private' => false,
            'title' => 'Новость 1',
            'text' => 'Текст первой новости про спорт',
        ], [
            'id' => 2,
            'category' => 1,
            'private' => true,
            'title' => 'Новость 2',
            'text' => 'Текст второй новости про спорт',
        ], [
            'id' => 3,
            'category' => 1,
            'private' => false,
            'title' => 'Новость 3',
            'text' => 'Текст третей новости про спорт',
        ], [
            'id' => 4,
            'category' => 2,
            'private' => true,
            'title' => 'Новость 4',
            'text' => 'Текст четвёртой новости про политику',
        ],
        [
            'id' => 5,
            'category' => 2,
            'private' => false,
            'title' => 'Новость 5',
            'text' => 'Текст пятой новости про политику',
        ],
        [
            'id' => 6,
            'category' => 2,
            'private' => false,
            'title' => 'Новость 6',
            'text' => 'Текст шестой новости про политику',
        ],
        [
            'id' => 7,
            'category' => 2,
            'private' => true,
            'title' => 'Новость 7',
            'text' => 'Текст седьмой новости про политику',
        ],
        [
            'id' => 8,
            'category' => 2,
            'private' => false,
            'title' => 'Новость 8',
            'text' => 'Текст восьмой новости про политику',
        ],
    ];

    public function getNews()
    {
        $db = Storage::disk('local');
        $contents = $db->get('db/news.json');
        $contents = json_encode($contents);
        var_dump($contents);
        die;
        return $this->news;
    }

    public function getCategories()
    {
        return $this->categories;
    }

}
