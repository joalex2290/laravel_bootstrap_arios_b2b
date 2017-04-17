<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = array(
            array('code' => '91', 'name' => 'Amazonas', 'country_id' => 44, ),
            array('code' => '5', 'name' => 'Antioquia', 'country_id' => 44, ),
            array('code' => '81', 'name' => 'Arauca', 'country_id' => 44, ),
            array('code' => '8', 'name' => 'Atlantico', 'country_id' => 44, ),
            array('code' => '11', 'name' => 'Bogota D.C', 'country_id' => 44, ),
            array('code' => '13', 'name' => 'Bolivar', 'country_id' => 44, ),
            array('code' => '15', 'name' => 'Boyaca', 'country_id' => 44, ),
            array('code' => '17', 'name' => 'Caldas', 'country_id' => 44, ),
            array('code' => '18', 'name' => 'Caqueta', 'country_id' => 44, ),
            array('code' => '85', 'name' => 'Casanare', 'country_id' => 44, ),
            array('code' => '19', 'name' => 'Cauca', 'country_id' => 44, ),
            array('code' => '20', 'name' => 'Cesar', 'country_id' => 44, ),
            array('code' => '27', 'name' => 'Choco', 'country_id' => 44, ),
            array('code' => '23', 'name' => 'Cordoba', 'country_id' => 44, ),
            array('code' => '25', 'name' => 'Cundinamarca', 'country_id' => 44, ),
            array('code' => '94', 'name' => 'Guainia', 'country_id' => 44, ),
            array('code' => '95', 'name' => 'Guaviare', 'country_id' => 44, ),
            array('code' => '41', 'name' => 'Huila', 'country_id' => 44, ),
            array('code' => '44', 'name' => 'La Guajira', 'country_id' => 44, ),
            array('code' => '47', 'name' => 'Magdalena', 'country_id' => 44, ),
            array('code' => '50', 'name' => 'Meta', 'country_id' => 44, ),
            array('code' => '52', 'name' => 'Narino', 'country_id' => 44, ),
            array('code' => '54', 'name' => 'Nte de Santander', 'country_id' => 44, ),
            array('code' => '86', 'name' => 'Putumayo', 'country_id' => 44, ),
            array('code' => '63', 'name' => 'Quindio', 'country_id' => 44, ),
            array('code' => '66', 'name' => 'Risaralda', 'country_id' => 44, ),
            array('code' => '88', 'name' => 'San Andres Providencia y Santa Catalina', 'country_id' => 44, ),
            array('code' => '68', 'name' => 'Santander', 'country_id' => 44, ),
            array('code' => '70', 'name' => 'Sucre', 'country_id' => 44, ),
            array('code' => '73', 'name' => 'Tolima', 'country_id' => 44, ),
            array('code' => '76', 'name' => 'Valle del Cauca', 'country_id' => 44, ),
            array('code' => '97', 'name' => 'Vaupes', 'country_id' => 44, ),
            array('code' => '99', 'name' => 'Vichada', 'country_id' => 44, ),
            );

        DB::table('departments')->insert($departments);
    }
}
