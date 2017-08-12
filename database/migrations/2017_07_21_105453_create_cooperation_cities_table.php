<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperationCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cooperation_cities', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('name');
            $table->integer('cooperation_province_id')->unsigned();
            $table->timestamps();
			
			$table->foreign('cooperation_province_id')->references('id')->on('cooperation_provinces')
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
		Schema::drop('cooperation_cities');
	}

}
