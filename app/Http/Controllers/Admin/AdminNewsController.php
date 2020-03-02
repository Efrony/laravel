<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\DataController;
use App\News;

class AdminNewsController extends DataController
{
    public function all()
    {
        $title = 'Все новости';
        return view('admin.news', [
            'title' => $title,
            'news' => News::paginate(8),
            'categories' => $this->categories,
        ]);
    }

    public function create()
    {

        if ($this->request->isMethod('post')) {
            $validFields = $this->validate($this->request, News::rules(), [], News::attributeNames());
            $oneNews = new News();
            $oneNews->fill($validFields);
            if ($url = News::imageForNews($this->request)) $oneNews->image = $url;
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

        $title = 'Добавить новость';
        return view('admin.newsCreate')->with([
            'title' => $title,
            'categories' => $this->categories,
        ]);
    }

    public function update(News $news)
    {
        $title = 'Редактирование новости';
        return view('admin.newsCreate')->with([
            'oneNews' => $news,
            'title' => $title,
            'categories' => $this->categories,
        ]);
    }

    public function save(News $news)
    {
        $validFields = $this->validate($this->request, News::rules(), [], News::attributeNames());
        $news->fill($validFields);
        if ($url = News::imageForNews($this->request)) $news->image = $url;
        if ($news->save()) {
            return redirect(route('admin.news.all'))->with('alert', [
                'type' => 'info',
                'message' => 'Новость успешно изменена!',
            ]);
        }
        return redirect(route('admin.news.all'))->with('alert', [
            'type' => 'danger',
            'message' => 'Что-то пошло не так!',
        ]);

    }


    public function delete(News $news)
    {
        if ($news->delete()) {
            return redirect(route('admin.news.all'))->with('alert', [
                'type' => 'info',
                'message' => 'Новость успешно удалена!',
            ]);
        }
        return redirect(route('admin.news.all'))->with('alert', [
            'type' => 'danger',
            'message' => 'Что-то пошло не так!',
        ]);

    }


}
