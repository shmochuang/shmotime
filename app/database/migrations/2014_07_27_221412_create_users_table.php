<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// create users table
		
		Schema::create('users', function($table) {

		    $table->increments('id');
		    $table->string('email')->unique();
		    $table->boolean('remember_token');
		    $table->string('password');
		    $table->string('firstname');
		    $table->string('lastname');
		    $table->string('phone');
		    $table->binary('photo');
		    $table->timestamps();
		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop table
		
		Schema::drop('users');
	}

}
