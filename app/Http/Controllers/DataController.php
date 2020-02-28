<?php


namespace App\Http\Controllers;


use App\Categories;
use App\News;
use Illuminate\Http\Request;

class DataController extends Controller
{
    protected  $request;
    protected  $news;
    protected  $categories;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->news = News::all();
        $this->categories = Categories::all();
    }
}
