<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make('12345678'),
                'admin' => true
            ], [
                'email' => 'user@user.ru',
                'name' => 'Гость',
                'password' => Hash::make('12345678'),
                'admin' => false
            ],
        ];

        return $data;
    }
}
