<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomWebsiteDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('custom_website_datas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('custom_website_id')->unsigned();
            $table->foreign('custom_website_id')->references('id')->on('custom_websites');
            $table->string('data_key');
            $table->longText('data_value');
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
		Schema::drop('custom_website_datas');
	}

}
