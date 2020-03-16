<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Jobs\NewsParsing;
use App\News;
use App\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Services\XMLParserService;

class ResourcesController extends Controller
{
    public function index()
    {
        return view('admin.resources', [
            'title' => 'Управление парсингом',
             'resources' => Resources::all()->sortByDesc('id'),
        ]);
    }
    public function load(XMLParserService $parserService)
    {
        $rssLink = DB::table('resources')->pluck('link');

        foreach ($rssLink as $link) {
            //$parserService->saveNews($link);
            NewsParsing::dispatch($link);
        }
        return redirect()->route('admin.resources.index')->with('alert', [
            'type' => 'success',
            'message' => 'Запущен процесс загрузки свежих новостей...'
        ]);
    }
}
