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
        // $this->call(UsersTableSeeder::class);
        \App\User::create([
            'avatar'    => 'default.png',
            'firstName' => 'Admin',
            'lastName'  => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@gmail.com',
            'email_verified_at' => date('Y-d-m h:i:s'),
            'password'  => \Illuminate\Support\Facades\Hash::make('12345678'),
            'role'      => 'admin'
        ]);
    }
}
