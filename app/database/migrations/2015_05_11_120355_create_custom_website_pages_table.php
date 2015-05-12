<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomWebsitePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('custom_website_pages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('custom_website_id')->unsigned();
            $table->foreign('custom_website_id')->references('id')->on('custom_websites');
            $table->string('name',50);
            $table->string('title',50);
            $table->string('slug',50);
            $table->longText('content');
            $table->boolean('isHome')->default(false);
            $table->enum('status',array('draft','publish','private'))->default('draft');
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
		Schema::drop('custom_website_pages');
	}

}
