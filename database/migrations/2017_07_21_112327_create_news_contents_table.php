<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_contents', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('title');
            $table->text('brief');
            $table->text('description');
			$table->enum('type', ['news', 'profile']);
            $table->string('status');
			$table->integer('owner_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('owner_id')->references('id')->on('users')
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
		//
		Schema::drop('news_contents');
	}

}
