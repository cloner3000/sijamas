<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldTypeDataInCooperationImplementation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cooperation_implementations', function(Blueprint $table)
		{
			// $table->text('description')->nullable();
			$table->dropColumn('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cooperation_implementations', function(Blueprint $table)
		{
			$table->dropColumn('description');
		});
	}

}
