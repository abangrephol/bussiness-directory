<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('custom_templates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name',80);
            $table->string('theme_name',50);
            $table->string('author',50)->nullable();
            $table->binary('thumbnail')->nullable();
            $table->binary('preview')->nullable();
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
        Schema::drop('custom_templates');
	}

}
