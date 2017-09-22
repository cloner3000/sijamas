<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldImageInCooperationImplementation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cooperation_implementations', function(Blueprint $table)
		{
			$table->string('image')->after('description')->nullable();
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
			$table->dropColumn('image');
		});
	}

}
