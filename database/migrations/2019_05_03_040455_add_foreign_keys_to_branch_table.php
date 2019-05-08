<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBranchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('branch', function(Blueprint $table)
		{
			$table->foreign('organization_id', 'branch_ibfk_1')->references('id')->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('branch_type', 'branch_ibfk_2')->references('id')->on('branch_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('branch', function(Blueprint $table)
		{
			$table->dropForeign('branch_ibfk_1');
			$table->dropForeign('branch_ibfk_2');
		});
	}

}
