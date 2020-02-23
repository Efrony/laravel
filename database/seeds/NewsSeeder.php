<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
        DB::table('categories')->insert($this->getData1());
        /**
         *  По непонятным причинам seeder запускается только из этого файла.
         *  При создании других сидеров постоянно вылетает сообщение типа Class CategoriesSeeder does not exist
         *  хотя если взять код из другого сидера и вставить в этот файл, то он запускается.
         *  Пробовал создавать с разными именами, всреано глючит
         *  Пако заполнение других таблиц сделал в этом сидере
         */
    }

    private function getData()
    {
        $faker = Faker\Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => $faker->realText(rand(30, 50)),
                'text' => $faker->realText(rand(1000, 1500)),
                'private' => (bool)rand(0, 1),
                'category' => (int)rand(1, 6),
                'image' => 'img/280.svg'
            ];
        }

        return $data;
    }

    private function getData1()
    {
        $date = Storage::disk('local')->get('db/categories.json');
        $date = json_decode($date, true);
        return $date;
    }
}
