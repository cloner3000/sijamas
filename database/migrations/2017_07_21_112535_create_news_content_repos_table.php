<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsContentReposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_content_repos', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('title');
            $table->string('filename');
			$table->integer('news_content_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('news_content_id')->references('id')->on('news_contents')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news_content_repos');
	}

}
