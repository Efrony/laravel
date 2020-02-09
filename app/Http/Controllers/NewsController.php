<?php

namespace App\Http\Controllers;


class NewsController extends Controller
{
    public function showNews()
    {
        $title = 'Новости';
        $news = ['Новость 1', 'Новость 2', 'Новость 3'];
        return view('news', compact('title', 'news'));

//        return view('news')->with([
//            'title' => $title,
//            'news' => $news,
//        ]);
    }
}
