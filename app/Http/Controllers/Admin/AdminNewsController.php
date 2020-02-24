<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\DataController;
use App\News;

class AdminNewsController extends DataController
{
    public function createNews()
    {
        $title = 'Добавить новость';
        return view('admin.newsCreate')->with([
            'title' => $title,
            'categories' => $this->categories,
        ]);
    }

    public function addNews()
    {
            if ($id = (new News())->addNews($this->request)) {
                return redirect(route('news.one', ['id' => $id]))->with('alert', [
                    'type' => 'success',
                    'message' => 'Новость успешно создана!',
                ]);
            }
            return redirect(route('admin.create'))->with('alert', [
                'type' => 'danger',
                'message' => 'Заполните все необходимые поля!',
            ]);
    }
}
