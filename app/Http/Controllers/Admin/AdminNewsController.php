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
            if ($id = (new News())->addNews($this->request)) {
                return redirect(route('news.one', ['id' => $id]))->with('alert', [
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

public
function update(News $news)
{
    dd($news);
}

public
function delete(News $news)
{
    dd($news);
}


}
