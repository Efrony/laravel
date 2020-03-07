<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = ['text', 'title', 'private', 'category', 'image'];

    public static function rules()
    {
        $categories = (new Categories())->getTable();
        return [
            'title' => 'required|min:3|max:50',
            'text' => 'required|min:20|max:4000',
            'category' => "required|exists:{$categories},id",
            'image' => 'mimes:jpeg,png|max:1500',
            'private' => 'boolean',
        ];
    }

    public static function attributeNames() {
        return [
            'title'                 => 'Заголовок',
            'text'                  => 'Описание новости',
            'category'              => 'Категория',
            'image'                 => 'Изображение для новости',
        ];
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
