<?php

namespace Tests\Feature;

use App\News;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function testCreateNews()
    {
        $response = $this->post('/admin/add', [
            'title' => 'test',
            'text' => '',
            'category' => 1,
            'private' => 1
        ]);

        $response->assertRedirect('/admin/create');
    }

    public function testJsonExist()
    {
        Storage::disk('local')->assertExists('db/news.json');
        Storage::disk('local')->assertExists('db/categories.json');
    }

    public function testViews()
    {
        $response = $this->get('/');
        $response->assertViewIs('index');

        $response = $this->get('/admin');
        $response->assertViewIs('admin.admin');

        $response = $this->get('/admin/create');
        $response->assertViewIs('admin.newsCreate');

        $response = $this->get('/news/');
        $response->assertViewIs('news.news');
    }

    public function testSeeText()
    {
        $response = $this->get('/news/categories/sport');
        $response->assertSeeText('Новости в категории Спорт');

        $response = $this->get('/news/show/3');
        $response
            ->assertSeeText('Текст третей новости про спорт')
            ->assertDontSeeText('Этого текста нет на странице');
    }

    public function testBasicPage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }


}



