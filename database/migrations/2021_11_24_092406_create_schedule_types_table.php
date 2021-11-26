<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->integer('week_no');
            $table->timestamps();
        });

        $this->seedDefault();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_types');
    }

    public function seedDefault()
    {
        $types = array(
            ['name' => 'weekly',    'description' => 'Schedule reoccurs every week.' ,    'week_no' => 1],
            ['name' => 'bi-weekly', 'description' => 'Schedule reoccurs every 2 weeks.',  'week_no' => 2],
            ['name' => 'tri-weekly','description' => 'Schedule reoccurs every 3 weeks.',  'week_no' => 3],
            ['name' => 'monthly',   'description' => 'Schedule reoccurs every 4 weeks.',  'week_no' => 4]
        );

        DB::table('schedule_types')->insert($types);
    }
}
