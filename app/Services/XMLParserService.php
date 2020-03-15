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
            preg_match('/\w+\.rss/', $link, $found);
            $category = (explode('.', $found[0])[0]);
            $titles = DB::table('categories')->pluck('name');
            Categories::
            dd($titles);


            $xml = XmlParser::load($link);
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses    ' => 'channel.link'],
                'text' => ['uses' => 'channel.description'],
                'image' => ['uses' => 'channel.image.url'],
                'news' => ['uses' => 'channel.item[title,link,guid,description,pubDate]']
            ]);

//            $filename = sprintf('logs%s.txt', time());
//            Storage::disk('publicLogs')->append($filename, date('c') . ' ' . $link);

            foreach ($data['news'] as $item) {
                $oneNews = new News();
                $oneNews->title = $item['title'];
                $oneNews->text = $item['description'] . ' ' . $item['link'];
                $oneNews->category = 1; //$category->id;
                $oneNews->private = (bool)rand(0, 1);
                $oneNews->save();
            }
    }
}
