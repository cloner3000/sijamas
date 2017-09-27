<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImportDataMouToCooperationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::table('cooperations', function(Blueprint $table)
		// {
		// 	//
		// });
		
        \DB::unprepared(file_get_contents(database_path('backup/importmou.sql')));
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
			//
		});
	}

}
