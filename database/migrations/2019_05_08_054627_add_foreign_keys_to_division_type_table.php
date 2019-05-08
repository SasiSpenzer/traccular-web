<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDivisionTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('division_type', function(Blueprint $table)
		{
			$table->foreign('organization_id', 'division_type_ibfk_1')->references('id')->on('organization')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('division_type', function(Blueprint $table)
		{
			$table->dropForeign('division_type_ibfk_1');
		});
	}

}
