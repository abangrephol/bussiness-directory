<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomTemplateDefaultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('custom_template_defaults', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('custom_templates');
            $table->string('name',50);
            $table->text('description');
            $table->string('page-filename',40);
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
		Schema::drop('custom_template_defaults');
	}

}
