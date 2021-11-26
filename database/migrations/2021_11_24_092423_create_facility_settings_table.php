<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('facility_id');
            $table->unsignedInteger('schedule_type')->nullable();
            $table->boolean('recurrence_menu')->default(0);
            $table->timestamp('cycle_startdate')->nullable();
            $table->timestamps();

            $table->foreign('facility_id')   ->references('id')->on('facilities')->onDelete('cascade');
            $table->foreign('schedule_type') ->references('id')->on('schedule_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_settings');
    }
}
