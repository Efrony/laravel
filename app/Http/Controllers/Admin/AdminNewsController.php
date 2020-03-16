<?php

namespace App\Http\Controllers\Admin;


use App\Categories;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNewsController extends Controller
{
    public function index()
    {
        return view('admin.news', [
            'title' => 'Все новости',
            'news' => News::paginate(8),
            'categories' => Categories::all(),
        ]);
    }

    public function create()
    {
        return view('admin.newsCreate')->with([
            'title' => 'Добавить новость',
            'categories' => Categories::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validFields = $this->validate($request, News::rules(), [], News::attributeNames());
        $oneNews = new News();
        $oneNews->fill($validFields);
        $oneNews->link = 'Created by ' . Auth::user()->name;
        if ($url = News::imageForNews($request)) $oneNews->image = $url;
        if ($oneNews->save()) {
            return redirect(route('news.one', ['id' => $oneNews->id]))->with('alert', [
                'type' => 'success',
                'message' => 'Новость успешно создана!',
            ]);
        }
        return redirect(route('admin.news.create'))->with('alert', [
            'type' => 'danger',
            'message' => 'Заполните все необходимые поля!',
        ]);
    }

    public function edit(News $news)
    {
        return view('admin.newsCreate')->with([
            'title' => 'Редактирование новости',
            'oneNews' => $news,
            'categories' => Categories::all(),
        ]);
    }

    public function update(Request $request, News $news)
    {
        $validFields = $this->validate($request, News::rules(), [], News::attributeNames());
        $news->fill($validFields);
        if ($url = News::imageForNews($request)) $news->image = $url;
        if ($news->save()) {
            return redirect(route('admin.news.index'))->with('alert', [
                'type' => 'info',
                'message' => 'Новость успешно изменена!',
            ]);
        }
        return redirect(route('admin.news.index'))->with('alert', [
            'type' => 'danger',
            'message' => 'Что-то пошло не так!',
        ]);
    }


    public function destroy(News $news)
    {
        if ($news->delete()) {
            return redirect(route('admin.news.index'))->with('alert', [
                'type' => 'info',
                'message' => 'Новость успешно удалена!',
            ]);
        }
        return redirect(route('admin.news.index'))->with('alert', [
            'type' => 'danger',
            'message' => 'Что-то пошло не так!',
        ]);
    }
}
