<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('facility_id');
            $table->unsignedInteger('menu_type');
            $table->date('day_menu');
            $table->integer('day_cycle_no')->nullable();
            $table->timestamps();

            $table->foreign('facility_id')  ->on('facilities')->references('id')->onDelete('cascade');
            $table->foreign('menu_type')    ->on('meal_types')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('menu_items', function (Blueprint $table){
            $table->dropForeign(['day_menu_id']);
            $table->dropColumn('day_menu_id');
        });

        Schema::dropIfExists('daily_menus');
    }
}
