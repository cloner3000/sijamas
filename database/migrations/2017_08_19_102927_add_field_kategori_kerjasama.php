<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldKategoriKerjasama extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cooperations', function(Blueprint $table)
		{
			$table->string('title')->after('id')->nullable();
			$table->string('month_period')->after('scope')->nullable();
			$table->string('year_period')->after('month_period')->nullable();
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
			$table->dropColumn(['title', 'month_period', 'year_period']);
		});
	}

}
