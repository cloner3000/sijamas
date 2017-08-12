<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperationImplementationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cooperation_implementations', function (Blueprint $table) {
        
            $table->increments('id');
            $table->integer('cooperation_id')->unsigned();
			$table->timestamp('implementation_date');
			$table->text('activity_type');
			$table->timestamp('description');
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
		Schema::drop('cooperation_implementations');
	}

}
