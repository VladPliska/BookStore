<?php

use Illuminate\Database\Seeder;
use App\models\User as User;
class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "username" => 'admin',
            "email" => 'admin@mail.com',
            "firstname" => 'admin',
            "lastname" => 'admin',
            'password'=>'admin'
        ]);
    }
}
