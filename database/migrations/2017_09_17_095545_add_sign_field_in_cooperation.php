<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSignFieldInCooperation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cooperations', function(Blueprint $table)
		{
			$table->string('first_sign')->after('cooperation_focus_id')->nullable();
			$table->string('second_sign')->after('first_sign')->nullable();
			$table->string('third_sign')->after('second_sign')->nullable();
			$table->string('first_sign_position')->after('third_sign')->nullable();
			$table->string('second_sign_position')->after('first_sign_position')->nullable();
			$table->string('third_sign_position')->after('second_sign_position')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cooperations', function(Blueprint $table)
		{
			$table->dropColumn(['first_sign','second_sign','third_sign','first_sign_position','second_sign_position','third_sign_position']);
		});
	}

}
