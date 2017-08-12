<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposedCooperationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proposed_cooperations', function (Blueprint $table) {
        
            $table->increments('id');
			$table->integer('owner_id')->unsigned();
			$table->string('name');
			$table->string('institute');
			$table->string('position');
			$table->text('address');
			$table->string('phone');
			$table->string('email');
			$table->text('message');
			$table->integer('proposed_cooperation_type_id')->unsigned();
			$table->string('filename');
			$table->enum('approval', ['draft', 'approved', 'rejected', 'deleted']);
            $table->timestamps();
			
			$table->foreign('owner_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
			
			$table->foreign('proposed_cooperation_type_id')->references('id')->on('proposed_cooperation_types')
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
		Schema::drop('proposed_cooperations');
	}

}
