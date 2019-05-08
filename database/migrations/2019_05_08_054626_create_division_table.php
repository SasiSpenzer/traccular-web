<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDivisionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('division', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('division_type')->index('division_type');
			$table->string('division_code', 100);
			$table->integer('contact_number');
			$table->string('email', 100);
			$table->integer('branch_id')->index('division_type_ibfk_1');
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
		Schema::drop('division');
	}

}
