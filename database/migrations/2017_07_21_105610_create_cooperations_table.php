<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cooperations', function (Blueprint $table){
			$table -> increments('id');
			$table -> string('slug');
			$table -> string('cooperation_number');
			$table -> enum('cooperation_category', ['dn', 'ln']);
			$table -> enum('cooperation_status', ['baru', 'lanjutan']);
			$table -> integer('cooperation_type_id')->unsigned();
			$table -> text('about');
			$table -> text('partners');
			$table -> text('address');
			$table -> text('scope');
			$table -> integer('cooperation_province_id')->unsigned();
			$table -> integer('cooperation_city_id')->unsigned();
			$table -> date('cooperation_signed');
			$table -> date('cooperation_ended');
			$table -> integer('cooperation_focus_id')->unsigned();
			$table -> enum('approval', ['draft', 'approved', 'rejected', 'deleted'])->default('draft');
			$table -> integer('owner_id')->unsigned();
			$table -> timestamps();
			
			$table->foreign('owner_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
				
			$table->foreign('cooperation_type_id')->references('id')->on('cooperation_types')
                ->onUpdate('cascade')
                ->onDelete('restrict');
				
			$table->foreign('cooperation_province_id')->references('id')->on('cooperation_provinces')
                ->onUpdate('cascade')
                ->onDelete('restrict');
				
			$table->foreign('cooperation_city_id')->references('id')->on('cooperation_cities')
                ->onUpdate('cascade')
                ->onDelete('restrict');
				
			$table->foreign('cooperation_focus_id')->references('id')->on('cooperation_focuses')
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
		Schema::drop('cooperations');
	}

}
