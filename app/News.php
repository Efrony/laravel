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
        $db = Storage::disk('local');
        $contents = $db->get('db/categories.json');
        $contents = json_decode($contents, true);
        return $contents;
    }
}
