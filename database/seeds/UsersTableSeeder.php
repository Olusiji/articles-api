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
        //
         $user1 = new User();
         $user1->name = "James Bond";
         $user1->email = "naijaphantom@gmail.com";
         $user1->password = md5('secretplace');
         $user1->save();
    }
}
