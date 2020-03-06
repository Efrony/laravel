<?php


namespace App\Http\Controllers;


use App\Categories;
use App\News;
use Illuminate\Http\Request;
use App\User;

class DataController extends Controller
{
    protected  $request;
    protected  $news;
    protected  $categories;
    protected  $users;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->news = News::all();
        $this->categories = Categories::all();
        $this->users = User::all();
    }
}
