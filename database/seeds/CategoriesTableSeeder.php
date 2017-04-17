<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = array(
    		array('name' => 'papeleria-oficina', 'label' => 'Papeleria y Oficina',),
    		array('name' => 'aseo', 'label' => 'Aseo y limpieza',),
    		array('name' => 'cafeteria', 'label' => 'Cafeteria',),
    		array('name' => 'refrigeracion', 'label' => 'Equipos de refrigeración',),
    		array('name' => 'insumos-medicos', 'label' => 'Medicamentos e insumos',),
    		);

    	DB::table('categories')->insert($categories);
    }
}
