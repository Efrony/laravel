<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    public function getNews()
    {
        $news = DB::table('news')->get();
        return $news;
    }

    public function getOneNews($id)
    {
        $oneNews = DB::table('news')->find($id);
        return $oneNews;
    }

//    public function getNewsByCategory($id)
//    {
//        $oneNews = DB::table('news')->find($id);
//        return $oneNews;
//    }

    public function getCategories()
    {
        $categories = DB::table('categories')->get();
        return $categories;
    }

    public function getOneCategory($id)
    {
        $oneCategory = DB::table('categories')->find($id);
        return $oneCategory;
    }

    public function getOneCategoryByName($name)
    {
        $oneCategory = DB::table('categories')->where('name', $name)->first();
        return $oneCategory;
    }
}
