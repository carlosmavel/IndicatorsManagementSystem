<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('domain');
            $table->string('initials');
            $table->string('definition');
            $table->integer('numerator');
            $table->integer('denominator');
            $table->double('result');
            $table->string('unit');
            $table->string('interest_area');
            $table->text('used_terms');
            $table->string('table');
            $table->string('status');   
            $table->timestamps();
            
            $table->foreign('user_id')->references('users')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicators');
    }
}
