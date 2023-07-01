<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("city_id")->unsigned()->nullable();
            $table->foreign("city_id")->references("id")->on("cities");

            $table->integer('province_id')->unsigned()->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');

            $table->timestamps();

            $table->index(['id', 'name', 'city_id', 'province_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
