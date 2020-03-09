<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        foreach ($categories as $category) {
            $xml = XmlParser::load("https://news.yandex.ru/{$category->name}.rss");
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses    ' => 'channel.link'],
                'text' => ['uses' => 'channel.description'],
                'image' => ['uses' => 'channel.image.url'],
                'news' => ['uses' => 'channel.item[title,link,guid,description,pubDate]']
            ]);

            foreach ($data['news'] as $item) {
                $oneNews = new News();
                $oneNews->title = $item['title'];
                $oneNews->text = $item['description'] . ' ' . $item['link'];
                $oneNews->category = $category->id;
                $oneNews->private = (bool)rand(0, 1);
                $oneNews->save();
            }
        }
        return redirect()->route('news.all');
    }
}
