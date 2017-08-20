<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTitleInTableProposedCooperation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proposed_cooperations', function(Blueprint $table)
		{
			$table->string('title')->after('id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('proposed_cooperations', function(Blueprint $table)
		{
			$table->dropColumn('title');
		});
	}

}
