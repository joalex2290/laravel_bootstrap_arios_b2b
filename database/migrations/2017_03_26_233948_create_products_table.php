<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('type')->default('I');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('reference')->nullable();
            $table->string('barcode')->nullable();
            $table->string('brand')->nullable();
            $table->float('tax');
            $table->integer('package_qty')->default(1);
            $table->string('unit_meassure')->default('Unidad');
            $table->text('comment')->nullable();
            $table->string('img_url')->default('product-default.png');
            $table->integer('active')->default(1);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
