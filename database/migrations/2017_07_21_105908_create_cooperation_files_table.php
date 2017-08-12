<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperationFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cooperation_files', function (Blueprint $table) {
        
            $table->increments('id');
            $table->integer('cooperation_id')->unsigned();
			$table->string('filename');
			$table->enum('type',['document','photo']);
            $table->timestamps();
			
			$table->foreign('cooperation_id')->references('id')->on('cooperations')
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
		Schema::drop('cooperation_files');
	}

}
