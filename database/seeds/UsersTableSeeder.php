<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::where('email', 'soooota1201@gmail.com')->first();

      if (!$user) {
        User::create([
          'name' => 'Sota',
          'email' => 'soooota1201@gmail.com',
          'role' => 'admin',
          'password' => Hash::make('password'),
        ]);
      }
    }
}
