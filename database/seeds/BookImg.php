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
        $allImg = scandir('/public/storage/bookImg');
        foreach($allImg as  $k => $v){
        if(strlen($v) < 5 ){
            continue;
        }
            Product::create([
                                'title' =>"Title Book ".$k,
                                'price' => rand(70,1000),
                                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ".$k,
                                'img'=>$v,
                                'genre_id' =>rand(1,12),
                                'author_id' => rand(1,30)
                            ]);
        }

    }
}
