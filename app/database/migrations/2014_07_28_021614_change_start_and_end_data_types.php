<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStartAndEndDataTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//change datatypes for start and end columns
		
		Schema::table('appointments', function($table) {
		    $table->dropColumn('start');
		    $table->dropColumn('end');
		    $table->time('start_time');
			$table->time('end_time');
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
		Schema::table('appointments', function($table) {
		    $table->datetime('start');
		    $table->datetime('end');
		    $table->dropColumn('start_time');
			$table->dropColumn('end_time');
		});
	}

}
