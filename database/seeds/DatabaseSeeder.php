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
        $this->call(Ganre::class);
        $this->call(Author::class);
        $this->call(BookImg::class);
        $this->call(Users::class);
    }
}
