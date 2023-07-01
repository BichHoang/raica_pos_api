<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');

            $table->integer('province_id')->unsigned()->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');

            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->integer('district_id')->unsigned()->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->integer('ward_id')->unsigned()->nullable();
            $table->foreign('ward_id')->references('id')->on('wards');

            $table->string('phone');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->index(['id', 'name', 'province_id', 'city_id', 'ward_id', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
