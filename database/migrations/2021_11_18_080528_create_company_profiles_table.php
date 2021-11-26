<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('address');
            $table->string('city');
            $table->integer('zip');
            $table->unsignedInteger('state_id')->nullable();
            $table->string('phone');
            $table->string('color');
            $table->unsignedInteger('logo')->nullable();
            $table->timestamps();

            $table->foreign('logo')       ->references('id')->on('media')->onDelete('cascade');
            $table->foreign('company_id') ->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('state_id')   ->references('id')->on('states')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_profiles');
    }
}
