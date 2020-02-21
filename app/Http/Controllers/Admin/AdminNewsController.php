<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Storage;

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
        if ($this->request->isMethod('post')) {
            $this->request->flash();
            $validFields = true;
            $fields = $this->request->except('_token');
            $createdNews = [];

            foreach ($fields as $field => $value) {
                if (!$value) {
                    $this->request->session()->put('_old_input.' . $field, 'empty');
                    $validFields = false;
                    continue;
                }
                $createdNews[$field] = $value;
            }

            if (!$validFields) {
                return redirect(route('admin.create'));
            }

            if (!isset($createdNews['private'])) $createdNews['private'] = 0;
            $createdNews['id'] = end($this->news)['id'] + 1;
            $this->news[] = $createdNews;
            Storage::disk('local')->put('db/news.json', json_encode($this->news, JSON_UNESCAPED_UNICODE));
            return redirect(route('news.all'));
        }
    }
}
