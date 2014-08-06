<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SwitchDayToUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// drop current day column, remake day unique
		Schema::table('appointments', function($table) {
		    $table->dropColumn('day');
		    $table->date('day_unique')->unique();
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
		    $table->dropColumn('day_unique');
		    $table->date('day');
		});
	}

}
