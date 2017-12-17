<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedNewUserSuperadminForDev extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$inputs['name'] = 'Trinata';
		$inputs['email'] = 'admin@trinatateknologi.com';
		$inputs['password'] = \Hash::make('simatupang');;
		$inputs['role_id'] = 1;
		$inputs['gender'] = 'pria';
		$inputs['address'] = 'Depok';
		$inputs['phone'] = '100';
		$inputs['username'] = 'trinata';
		$inputs['created_at'] = date('Y-m-d H:i:s');
		$inputs['updated_at'] = date('Y-m-d H:i:s');

		\DB::table('users')->insert($inputs);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		\DB::table('users')->whereUsername('trinata')->delete();
	}

}
