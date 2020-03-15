<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(CategoriesSeeder::class);
       // $this->call(NewsSeeder::class);
        $this->call(UsersSeeder::class); //  admin@admin.ru user@user.ru passwords: 123
    }
}
