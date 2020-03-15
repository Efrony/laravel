<?php


namespace App\Services;


use App\Categories;
use App\News;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Facades\DB;

class XMLParserService
{
    public function saveNews($link)
    {
            $xml = XmlParser::load($link);
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses    ' => 'channel.link'],
                'text' => ['uses' => 'channel.description'],
                'image' => ['uses' => 'channel.image.url'],
                'news' => ['uses' => 'channel.item[title,id,link,guid,description,pubDate]']
            ]);

//            $filename = sprintf('logs%s.txt', time());
//            Storage::disk('publicLogs')->append($filename, date('c') . ' ' . $link);

            $category = $this->checkCategory($link);
            $links = DB::table('news')->pluck('link');

            foreach ($data['news'] as $item) {
                if (!$links->contains($item['link'])) {
                    $this->createNews($item, $category);
                }
            }

    }

    public function createNews($item, $category)
    {
            $oneNews = new News();
            $oneNews->title = $item['title'];
            $oneNews->text = $item['description'];
            $oneNews->category = $category;
            $oneNews->private = (bool)rand(0, 1);
            $oneNews->link = $item['link'];
            $oneNews->save();
    }


    public function checkCategory($link)
    {
        preg_match('/\w+\.rss/', $link, $found);
        $categoryName = (explode('.', $found[0])[0]);
        $categories = Categories::all();

        if (!$categories->contains('name', $categoryName)){
            $category = new Categories();
            $category->name = $categoryName;
            $category->title = $categoryName;
            $category->save();
        } else {
            return $categories->where('name', $categoryName)->first()->id;
        }
        return $category->id;
    }

}
