<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTitleInCooperationImplementation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cooperation_implementations', function(Blueprint $table)
		{
			$table->string('title')->after('user_id')->nullable();
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
			$table->dropColumn('title');
		});
	}

}
