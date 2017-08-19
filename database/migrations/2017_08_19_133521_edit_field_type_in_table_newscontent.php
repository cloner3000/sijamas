<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFieldTypeInTableNewscontent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('news_contents', function(Blueprint $table)
		{
			\DB::statement("ALTER TABLE news_contents MODIFY COLUMN type ENUM('news', 'profile', 'banner')");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('news_contents', function(Blueprint $table)
		{
			\DB::statement("ALTER TABLE news_contents MODIFY COLUMN type ENUM('news', 'profile')");
		});
	}

}
