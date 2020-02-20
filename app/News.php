<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    public function getNews()
    {
        $db = Storage::disk('local');
        $contents = $db->get('db/news.json');
        $contents = json_decode($contents, true);
        return $contents;
    }

    public function getCategories()
    {
        $db = Storage::disk('local');
        $contents = $db->get('db/categories.json');
        $contents = json_decode($contents, true);
        return $contents;
    }
}
