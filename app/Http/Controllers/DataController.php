<?php


namespace App\Http\Controllers;


use App\News;
use Illuminate\Http\Request;

class DataController extends Controller
{
    protected  $request;
    protected  $news;
    protected  $categories;

    public function __construct(Request $request, News $news)
    {
        $this->request = $request;
        $this->news = $news->getNews();
        $this->categories = $news->getCategories();

    }
}
