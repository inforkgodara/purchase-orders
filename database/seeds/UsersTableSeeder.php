<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Ramesh Kumar',
            'email'     => 'rameshkumar@gmail.com',
            'password'  => bcrypt('admin')
        ]);
    }
}
