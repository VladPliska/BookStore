<?php

use Illuminate\Database\Seeder;
use App\models\Ganre as Genres;

class Ganre extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ganres = [
            'Пригоди',"Фантастика","Романи","Наука","Наукова фантастика","Проза","Бойовик","Детективи","Документал","Вірші",
            "Гумор","Наука","Саморозвиток"
        ];
        foreach($ganres as $k => $v){
            Genres::create([
                "name" => $ganres[$k]
            ]);
        }
    }
}
