<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getData());

    }

    private function getData()
    {
        $data = [
            [
                'email' => 'admin@admin.ru',
                'name' => 'Администратор',
                'password' => '$2y$10$FIbERmei8XgIgL7vshnkKuLoIlEZgaUfCULrJSZbxl1WqrPUh401S' // password: 12345678
            ], [
                'email' => 'user@user.ru',
                'name' => 'Гость',
                'password' => '$2y$10$FIbERmei8XgIgL7vshnkKuLoIlEZgaUfCULrJSZbxl1WqrPUh401S' // password: 12345678
            ],
        ];

        return $data;
    }
}
