<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('facility_id');
            $table->string('name');
            $table->longText('description');

            $table->string('pos_image')->nullable();
            $table->bigInteger('ref_id')->nullable();
            $table->date('expire_date');
            $table->string('slug')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('company_id') ->references('id')->on('companies') ->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
