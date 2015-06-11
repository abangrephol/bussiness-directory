<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldCustomTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('custom_templates', function(Blueprint $table)
        {
            $table->renameColumn('template_id','theme_id');
            $table->string('type',20)->nullable();
            $table->longText('template')->nullable();
            $table->longText('data')->nullable();

        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('custom_templates', function(Blueprint $table)
        {
            $table->renameColumn('theme_id','template_id');
            $table->string('type',20)->nullable();
            $table->longText('template')->nullable();
            $table->longText('data')->nullable();
            $table->dropColumn(array('type', 'template', 'data'));
        });
	}

}
