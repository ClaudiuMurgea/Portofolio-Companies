<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('displays', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('facility_id');
            $table->unsignedInteger('display_type');
            $table->unsignedInteger('media_id')->nullable();
            $table->string('name');
            $table->text('color_code')->nullable();
            $table->boolean('horizontal')->default(1);
            $table->string('identifier')->unique();
            $table->string('vpn_ip');
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('media_id')     ->references('id')->on('media')->onDelete('cascade');
            $table->foreign('facility_id')  ->references('id')->on('facilities')->onDelete('cascade');
            $table->foreign('display_type') ->references('id')->on('display_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('displays');
    }
}
