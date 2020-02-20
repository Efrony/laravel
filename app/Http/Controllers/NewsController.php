<?php

namespace App\Http\Controllers;


use App\News;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    private  $request;
    private  $news;
    private  $categories;

    public function __construct(Request $request, News $news)
    {
        $this->request = $request;
        $this->news = $news->getNews();
        $this->categories = $news->getCategories();
    }


    public function showCategory($category)
    {
        foreach ($this->categories as $oneCategory) {
            if ($oneCategory['category'] == $category) {
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
        return redirect(route('news.all'));
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


    public function createNews()
    {
        $title = 'Добавить новость';
        return view('news.newsCreate')->with([
            'title' => $title,
            'categories' => $this->categories,
        ]);
    }


    public function addNews()
    {
        if ($this->request->isMethod('post')) {
            $this->request->flash();
            $validFields = true;
            $fields = $this->request->except('_token');
            $createdNews = [];

            foreach ($fields as $field => $value) {
                if (!$value) {
                    $this->request->session()->put('_old_input.' . $field, 'empty');
                    $validFields = false;
                    continue;
                }
                $createdNews[$field] = $value;
            }

            if (!$validFields) {
                return redirect(route('news.create'));
            }

            if (!isset($createdNews['private'])) $createdNews['private'] = 0;
            $createdNews['id'] = end($this->news)['id'] + 1;
            $this->news[] = $createdNews;
            Storage::disk('local')->put('db/news.json', json_encode($this->news, JSON_UNESCAPED_UNICODE));
            return redirect(route('news.all'));
        }
    }
}
