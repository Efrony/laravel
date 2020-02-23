<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('title')->comment('Заголовок новости');
            $table->text('text')->comment('Содержание новости');
            $table->boolean('private')
                ->default(false)
                ->comment('Приватная новость');
            $table->string('image')
                ->default('img/280.svg')
                ->comment('Путь к изображению');
            $table->integer('category')
                ->default(0)
                ->comment('Категория');
            $table->bigIncrements('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
