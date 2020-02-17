<?php

namespace App\Http\Controllers;


use App\News;
use Faker\Provider\Lorem;

class NewsController extends Controller
{
    private $categories;
    private $news;

    public function getNews()
    {
        return (new News())->getNews();
    }
    public function getCategories()
    {
        return(new News())->getCategories();
    }


    public function showCategory($category)
    {
        foreach ($this->getCategories() as $oneCategory) {
            if ($oneCategory['category'] == $category) {
                $category = $oneCategory;
                break;
            }
        }

        $title = 'Новости в категории ' . $category['title'];
        $newsByCategory = [];

        foreach ($this->getNews() as $new) {
            if ($new['category'] == $category['id']) {
                $newsByCategory[] = $new;
            }
         }

        return view('news.news')->with([
            'title' => $title,
            'news' => $newsByCategory,
            'categories' => $this->getCategories(),
        ]);
    }

    public function oneNews($id)
    {
        foreach ($this->getNews() as $new) {
            if ($new['id'] == $id) {
                return view('news.newsOne')->with([
                    'title' => $new['title'],
                    'new' => $new,
                    'categories' => $this->getCategories(),
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
            'news' => $this->getNews(),
            'categories' => $this->getCategories(),
        ]);
    }

    public function addNews()
    {
        $title = 'Добавить новость';
        return view('news.newsAdd')->with([
            'title' => $title,
            'categories' => $this->getCategories(),
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
