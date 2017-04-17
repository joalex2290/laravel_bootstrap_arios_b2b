<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = array(
    		array('name' => 'superadmin', 'label' => 'Administrador del sistema', 'description' => 'Administrador del sistema'),
    		array('name' => 'administrador', 'label' => 'Administrador de la organización', 'description' => 'Administrador de la organización, crea oficinas, empleados, agrega catalogos y empleados a las oficinas, autoriza pedidos del usuario revisor y ordenador'),
    		array('name' => 'supervisor', 'label' => 'Supervisor de oficina', 'description' => 'Supervisor de oficina, crea empleados de sus oficinas y autoriza pedidos de usuario ordenador y revisor de las oficinas a las que pertenece.'),
            array('name' => 'revisor', 'label' => 'Revisor de Oficina', 'description' => 'Revisor pedidos de oficina, usuario que autoriza pedidos de oficina generados por el ordenador'),
    		array('name' => 'ordenador', 'label' => 'Generador del gasto', 'description' => 'Generador del gasto, realiza solicitudes de pedido.'),
    		array('name' => 'vendedor', 'label' => 'Gestor de pedidos', 'description' => 'Usuario que gestiona los pedidos de las organizaciones, crea productos, catalogos, empleados, oficinas'),
    		);

    	DB::table('roles')->insert($roles);
    }
}
