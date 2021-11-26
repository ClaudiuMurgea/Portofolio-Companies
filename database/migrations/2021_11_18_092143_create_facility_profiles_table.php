<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('facility_id');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->string('phone');
            $table->string('color')->nullable();
            $table->unsignedInteger('logo')->nullable();
            $table->timestamps();

            $table->foreign('facility_id')  ->references('id')->on('facilities')->onDelete('cascade');
            $table->foreign('state_id')     ->references('id')->on('states')->onDelete('cascade');
            $table->foreign('region_id')    ->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('logo')         ->references('id')->on('media')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_profiles');
    }
}
