<?php

use Illuminate\Database\Seeder;
use App\models\Author as Authors;

class Author extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($a = 1; $a < 31; $a++){
            Authors::create([
                "name" => 'Автор '.$a
            ]);
        }
    }
}
