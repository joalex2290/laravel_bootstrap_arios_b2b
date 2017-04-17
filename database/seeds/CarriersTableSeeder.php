<?php

use Illuminate\Database\Seeder;

class CarriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$carriers = array(
    		array('name' => 'servientrega', 'label' => 'Servientrega'),
    		array('name' => 'redetrans', 'label' => 'RedeTrans'),
    		);

    	DB::table('carriers')->insert($carriers);
    }
}
