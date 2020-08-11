<?php

use App\Entity\User;
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
        // $this->call(UsersTableSeeder::class);

        User::create([
            'name' => 'Василий',
            'surname' => 'Пупкин',
            'patronymic' => 'Василевич',
            'role' => User::ROLE_DIRECTOR,
            'email' => 'test@test.ru',
            'password' => Hash::make('password')
        ]);
    }
}
