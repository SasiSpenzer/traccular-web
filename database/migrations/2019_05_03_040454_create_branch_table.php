<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('organization_id')->index('organization_id');
			$table->string('branch_code', 50);
			$table->string('branch_name', 100);
			$table->integer('branch_type')->index('branch_type');
			$table->integer('contact_number');
			$table->string('email', 150);
			$table->string('address', 200);
			$table->enum('status', array('1','0'))->default('1');
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
		Schema::drop('branch');
	}

}
