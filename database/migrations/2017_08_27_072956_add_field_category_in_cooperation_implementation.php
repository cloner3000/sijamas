<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCategoryInCooperationImplementation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cooperation_implementations', function(Blueprint $table)
		{
			$table->integer('user_id')->after('cooperation_id')->default(0);
			$table->enum('category', ['perencanaan', 'implementation'])->after('description')->default('perencanaan');
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
			$table->dropColumn(['user_id', 'category']);
		});
	}

}
