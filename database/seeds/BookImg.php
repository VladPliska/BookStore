<?php


use Illuminate\Database\Seeder;
use App\models\Product as Product;

class BookImg extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        $allImg = scandir('../BookStore/storage/bookImg');
        foreach($allImg as  $k => $v){
        if(strlen($v) < 5 ){
            continue;
        }
            Product::create([
                                'title' =>"Title Book ".$k,
                                'price' => rand(70,1000),
                                'description' => "description ".$k,
                                'img'=>$v,
                                'ganre' =>rand(1,12)
                            ]);
        }

    }
}
