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
        //  dump(scandir('../BookStore/testImg'));
        $allImg = scandir('../BookStore/bookImg');
        foreach($allImg as  $k => $v){
            Product::create(['title' =>"Title Book ".$k,'price' => rand(70,1000),'description' => "description ".$k,'img'=>"../bookImg/".$v]);
        }

    }
}
