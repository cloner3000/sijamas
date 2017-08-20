<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldDeleteAtInTableProposedCooperation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proposed_cooperations', function(Blueprint $table)
		{
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
		Schema::table('proposed_cooperations', function(Blueprint $table)
		{
			$table->dropColumn('delete_at');
		});
	}

}
