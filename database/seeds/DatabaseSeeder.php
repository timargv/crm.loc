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
            'role' => User::ROLE_ADMIN,
            'email' => 'test@test.ru',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Василий2',
            'surname' => 'Пупкин2',
            'patronymic' => 'Василевич2',
            'role' => User::ROLE_DIRECTOR,
            'email' => 'test2@test.ru',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Василий3',
            'surname' => 'Пупкин3',
            'patronymic' => 'Василевич3',
            'role' => User::ROLE_COLLABORATOR,
            'email' => 'test3@test.ru',
            'password' => Hash::make('password')
        ]);
    }
}
