<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = ['text', 'title', 'private', 'category', 'image'];


    public static function addNews(Request $request)
    {
        $request->flash();
        $validFields = true;
        $fields = $request->except('_token');
        $createdNews = [];

        foreach ($fields as $field => $value) {
            if ($field != 'private' && !$value) {
                $request->session()->put('_old_input.' . $field, 'empty');
                $validFields = false;
                continue;
            }
            $createdNews[$field] = $value;
        }

        if (!$validFields) return false;
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

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category')->first();
    }
}
