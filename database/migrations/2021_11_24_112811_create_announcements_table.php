<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('facility_id');
            $table->string('title');
            $table->text('announcement');
            $table->timestamp('start_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_at')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('announcements');
    }
}
