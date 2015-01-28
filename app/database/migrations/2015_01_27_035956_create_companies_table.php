<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('contact_name', 50);
			$table->string('phone', 20);
			$table->string('fax', 20)->nullable();
			$table->string('email', 50);
			$table->string('address_1');
			$table->string('address_2')->nullable();
			$table->string('postcode', 10);
			$table->string('city', 50);
			$table->string('website', 70)->nullable();
			$table->text('short_description')->nullable();
			$table->text('description');
			$table->text('tags')->nullable();
            $table->softDeletes();
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
		Schema::drop('companies');
	}

}
