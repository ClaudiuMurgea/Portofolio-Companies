<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $this->seedDefaults();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('display_types');
    }

    public function seedDefaults ()
    {
        $types = array(
            ['id' => 1, 'name' => 'HR'],
            ['id' => 2, 'name' => 'Banners'],
            ['id' => 3, 'name' => 'Menu']
        );

        DB::table('display_types')->insert($types);
        
    }
}
