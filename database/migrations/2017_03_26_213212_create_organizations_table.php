<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('tax_id');
            $table->string('name');
            $table->string('comercial_name')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('address');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('avatar_url')->default('organization-default.png');
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
        Schema::drop('organizations');
    }
}
