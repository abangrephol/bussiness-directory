<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomDataToCustomWebsitePage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('custom_website_pages', function(Blueprint $table)
        {
            $table->longText('custom_data')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('custom_website_pages', function(Blueprint $table)
        {
            $table->dropColumn('custom_data');
        });
	}

}
