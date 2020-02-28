<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = ['text', 'title', 'private', 'category', 'image'];


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

    public static function addNews(Request $request)
    {
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

        if (!$validFields) return false;
        if (!isset($fields['private'])) $createdNews['private'] = 0;
        if ($url = News::imageForNews($request)) $createdNews['image'] = $url;

        $oneNews = new News();
        $oneNews->fill($createdNews);
        $oneNews->save();
        return $oneNews->id;
    }

    public static function imageForNews(Request $request)
    {
        if ($file = $request->file('image')) {
            $path = $file->store('public'); //Storage::putFile('public', $file);
            return Storage::url($path);
        }
        return false;
    }
}
