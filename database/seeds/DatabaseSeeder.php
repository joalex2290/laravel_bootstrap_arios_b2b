<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(CountriesTableSeeder::class);
    	$this->call(DepartmentsTableSeeder::class);
    	$this->call(CitiesTableSeeder::class);
    	$this->call(RolesTableSeeder::class);
    	$this->call(AdminUserTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CarriersTableSeeder::class);
    }
}
