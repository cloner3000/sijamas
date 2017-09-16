<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSortInProposedCooperationType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proposed_cooperation_types', function(Blueprint $table)
		{
			$table->integer('sort')->after('name')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('proposed_cooperation_types', function(Blueprint $table)
		{
			$table->dropColumn('sort');
		});
	}

}
