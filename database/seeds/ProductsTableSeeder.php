<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$products = array(
    		array('code' => 'A1', 'name' => 'Jabon liquido', 'tax' => 19, 'category_id' => 2,),
    		array('code' => 'A2', 'name' => 'Papel Higienico', 'tax' => 19, 'category_id' => 2,),
    		array('code' => 'B1', 'name' => 'Boligrafo Retractil', 'tax' => 19, 'category_id' => 1,),
    		array('code' => 'B2', 'name' => 'Cuaderno rayado 80 hojas', 'tax' => 19, 'category_id' => 1,),
    		array('code' => 'C2', 'name' => 'Tapabocas 4 Tiras', 'tax' => 0, 'category_id' => 4,),
    		array('code' => 'C3', 'name' => 'Aire Acondicionado 80 C', 'tax' => 19, 'category_id' => 3,),
    		);

    	DB::table('products')->insert($products);
    }
}
