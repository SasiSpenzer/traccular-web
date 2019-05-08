<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDivisionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('division', function(Blueprint $table)
		{
			$table->foreign('branch_id', 'division_ibfk_1')->references('id')->on('branch')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('division_type', 'division_ibfk_2')->references('id')->on('division_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('division', function(Blueprint $table)
		{
			$table->dropForeign('division_ibfk_1');
			$table->dropForeign('division_ibfk_2');
		});
	}

}
