<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create appointment table
		
		Schema::create('appointments', function($table) {
			
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->datetime('start');
			$table->datetime('end');
			$table->text('instructions');
			$table->timestamps();
			
			// connect table to users
			$table->foreign('user_id')->references('id')->on('users');
			
								
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//drop it like its hot
		Schema::drop('appointments');
	}

}
