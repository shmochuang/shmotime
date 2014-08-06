<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStartEndDataTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('appointments', function($table) {
		    $table->dropColumn('day');
		    $table->dropColumn('start_time');
		    $table->dropColumn('end_time');
		    $table->datetime('start');
			$table->datetime('end');
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
		    $table->date('day');
		    $table->time('start_time');
			$table->time('end_time');
		    $table->dropColumn('start');
		    $table->dropColumn('end');
		    
		});
	}

}
