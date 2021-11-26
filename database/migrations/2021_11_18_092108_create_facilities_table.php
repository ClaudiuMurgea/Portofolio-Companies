<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('company_id')  ->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('admin_id') ->nullable();
            $table->unsignedBigInteger('editor_id')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')  ->onDelete('cascade');
            $table->foreign('region_id') ->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('admin_id')  ->references('id')->on('users')      ->onDelete('cascade');
            $table->foreign('editor_id') ->references('id')->on('users')      ->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilities');
    }
}
