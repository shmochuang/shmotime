<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstname extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// add username column
		Schema::table('appointments', function($table) {
		    $table->string('username');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop it like it's hot
		Schema::table('appointments', function($table) {
		    $table->dropColumn('username');
		});
	}

}
