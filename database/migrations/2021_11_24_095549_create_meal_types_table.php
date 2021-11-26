<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('always_available')->default(0);
            $table->timestamps();
        });

        $this->seedDefaultTypes();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_types');
    }

    public function seedDefaultTypes ()
    {
        $types = array(
            ['id' => 1, 'name' => 'Breakfast',        'always_available' => 0],
            ['id' => 2, 'name' => 'Lunch',            'always_available' => 0],
            ['id' => 3, 'name' => 'Dinner',           'always_available' => 0],
            ['id' => 4, 'name' => 'Always Available', 'always available' => 1]
        );

        DB::table('meal_types')->insert($types);
    }
}
