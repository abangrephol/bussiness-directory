<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('custom_widgets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('type',20);
            $table->string('name',80);
            $table->longText('template')->nullable();
            $table->string('location',20)->nullable();
            $table->longText('data')->nullable();
            $table->integer('theme_id')->unsigned()->nullable();
            $table->foreign('theme_id')->references('id')->on('custom_themes');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('custom_widgets');
	}

}
