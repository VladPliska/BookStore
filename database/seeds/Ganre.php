<?php

use Illuminate\Database\Seeder;
use App\models\Ganre as Ganres;

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
            'Пригоди',"Фантастика","Романи","Наука","Наукова фантастика","Проза","Бовик","Детективи","Документал","Вірші",
            "Гумор","Наука","Саморозвиток"
        ];
        foreach($ganres as $v){
            Ganres::create([
                "name" => $ganres[rand(0,12)]
            ]);
        }
    }
}
