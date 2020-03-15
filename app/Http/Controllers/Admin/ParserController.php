<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Jobs\NewsParsing;
use App\News;
use App\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Services\XMLParserService;

class ParserController extends Controller
{
    public function index()
    {
        return view('admin.parser', [
            'title' => 'Управление парсингом',
             'resources' => Resources::paginate(10),
        ]);
    }
    public function load(XMLParserService $parserService)
    {
        $rssLink = [
            'https://news.yandex.ru/auto.rss',
            'https://news.yandex.ru/auto_racing.rss',
            'https://news.yandex.ru/army.rss',
            'https://news.yandex.ru/gadgets.rss',
            'https://news.yandex.ru/index.rss',
            'https://news.yandex.ru/martial_arts.rss',
            'https://news.yandex.ru/communal.rss',
            'https://news.yandex.ru/health.rss',
            'https://news.yandex.ru/games.rss',
            'https://news.yandex.ru/internet.rss',
            'https://news.yandex.ru/cyber_sport.rss',
            'https://news.yandex.ru/movies.rss',
            'https://news.yandex.ru/cosmos.rss',
            'https://news.yandex.ru/culture.rss',
     //       'https://news.yandex.ru/fire.rss',
            'https://news.yandex.ru/championsleague.rss',
            'https://news.yandex.ru/music.rss',
            'https://news.yandex.ru/nhl.rss',
        ];

        foreach ($rssLink as $link) {
            //$parserService->saveNews($link);
            NewsParsing::dispatch($link);
        }
        return redirect()->route('news.all');
    }
}
