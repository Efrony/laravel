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
                'password' => Hash::make('123'),
                'admin' => true
            ], [
                'email' => 'user1@user.ru',
                'name' => 'Пользователь 1',
                'password' => Hash::make('123'),
                'admin' => false
            ], [
                'email' => 'user2@user.ru',
                'name' => 'Пользователь 2',
                'password' => Hash::make('123'),
                'admin' => false
            ],
        ];

        return $data;
    }
}
