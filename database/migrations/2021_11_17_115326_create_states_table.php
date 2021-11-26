<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name');
            $table->string('name');
            $table->timestamps();
            
        });

        $this->seedStates();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }

    private function seedStates() {

        $states = array(
            ['short_name' =>' AK', 'name' =>'Alaska'],
            ['short_name' =>' AL', 'name' =>'Alabama'],
            ['short_name' =>' AR', 'name' =>'Arkansas'],
            ['short_name' =>' AZ', 'name' =>'Arizona'],
            ['short_name' =>' CA', 'name' =>'California'],
            ['short_name' =>' CO', 'name' =>'Colorado'],
            ['short_name' =>' CT', 'name' =>'Connecticut'],
            ['short_name' =>' DC', 'name' =>'District of Columbia'],
            ['short_name' =>' DE', 'name' =>'Delaware'],
            ['short_name' =>' FL', 'name' =>'Florida'],
            ['short_name' =>' GA', 'name' =>'Georgia'],
            ['short_name' =>' HI', 'name' =>'Hawaii'],
            ['short_name' =>' IA', 'name' =>'Iowa'],
            ['short_name' =>' ID', 'name' =>'Idaho'],
            ['short_name' =>' IL', 'name' =>'Illinois'],
            ['short_name' => 'IN', 'name' =>'Indiana'],
            ['short_name' =>' KS', 'name' =>'Kansas'],
            ['short_name' =>' KY', 'name' =>'Kentucky'],
            ['short_name' =>' LA', 'name' =>'Louisiana'],
            ['short_name' =>' MA', 'name' =>'Massachusetts'],
            ['short_name' =>' MD', 'name' =>'Maryland'],
            ['short_name' =>' ME', 'name' =>'Maine'],
            ['short_name' =>' MI', 'name' =>'Michigan'],
            ['short_name' =>' MN', 'name' =>'Minnesota'],
            ['short_name' =>' MO', 'name' =>'Missouri'],
            ['short_name' =>' MS', 'name' =>'Mississippi'],
            ['short_name' =>' MT', 'name' =>'Montana'],
            ['short_name' =>' NC', 'name' =>'North Carolina'],
            ['short_name' =>' ND', 'name' =>'North Dakota'],
            ['short_name' =>' NE', 'name' =>'Nebraska'],
            ['short_name' =>' NH', 'name' =>'New Hampshire'],
            ['short_name' =>' NJ', 'name' =>'New Jersey'],
            ['short_name' =>' NM', 'name' =>'New Mexico'],
            ['short_name' =>' NV', 'name' =>'Nevada'],
            ['short_name' =>' NY', 'name' =>'New York'],
            ['short_name' =>' OH', 'name' =>'Ohio'],
            ['short_name' =>' OK', 'name' =>'Oklahoma'],
            ['short_name' =>' OR', 'name' =>'Oregon'],
            ['short_name' =>' PA', 'name' =>'Pennsylvania'],
            ['short_name' =>' PR', 'name' =>'Puerto Rico'],
            ['short_name' =>' RI', 'name' =>'Rhode Island'],
            ['short_name' =>' SC', 'name' =>'South Carolina'],
            ['short_name' =>' SD', 'name' =>'South Dakota'],
            ['short_name' =>' TN', 'name' =>'Tennessee'],
            ['short_name' =>' TX', 'name' =>'Texas'],
            ['short_name' =>' UT', 'name' =>'Utah'],
            ['short_name' =>' VA', 'name' =>'Virginia'],
            ['short_name' =>' VT', 'name' =>'Vermont'],
            ['short_name' =>' WA', 'name' =>'Washington'],
            ['short_name' =>' WI', 'name' =>'Wisconsin'],
            ['short_name' =>' WV', 'name' =>'West Virginia'],
            ['short_name' =>' WY', 'name' =>'Wyoming'],

        );

        DB::table('states')->insert($states);


    }

}
