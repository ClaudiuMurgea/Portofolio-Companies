<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayNetworkSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_network_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('display_id');
            $table->string('display_identifier');
            $table->string('mac');
            $table->string('ip');
            $table->string('vpn_ip');
            $table->boolean('is_online')->default(0);
            $table->timestamp('last_pinged')->nullable();
            $table->timestamp('last_online')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('display_network_settings');
    }
}
