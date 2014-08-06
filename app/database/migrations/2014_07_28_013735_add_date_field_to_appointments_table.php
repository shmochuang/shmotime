<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateFieldToAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// add date field to appointments table
		Schema::table('appointments', function($table) {
			$table->date('day');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop date column
		
		Schema::table('appointments', function($table) {
		    $table->dropColumn('day');
		});
	}

}
