<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
//    public function getNews()
//    {
//        $news = DB::table('news')->get();
//        $news = News::all()->toArray();
//        return $news;
//    }

//    public function getOneNews(News $oneNews)
//    {
////        $oneNews = DB::table('news')->find($id);
//        return $oneNews;
//    }

//    public function getNewsByCategory($id)
//    {
//        $oneNews = DB::table('news')->find($id);
//        return $oneNews;
//    }

//    public function getCategories()
//    {
//        $categories = DB::table('categories')->get();
//        return $categories;
//    }

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

    public function addNews(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->flash();
            $validFields = true;
            $fields = $request->except('_token');
            $createdNews = [];

            foreach ($fields as $field => $value) {
                if (!$value) {
                    $request->session()->put('_old_input.' . $field, 'empty');
                    $validFields = false;
                    continue;
                }
                $createdNews[$field] = $value;
            }
            if (!$validFields)  return false;
            if ($url = $this->imageForNews($request)) $createdNews['image'] = $url;

            return  DB::table('news')->insertGetId($createdNews);
        }
    }

    public function imageForNews(Request $request)
    {
        if ($file = $request->file('image')) {
            $path = Storage::putFile('public', $file);
            return Storage::url($path);
        }
        return false;
    }
}
