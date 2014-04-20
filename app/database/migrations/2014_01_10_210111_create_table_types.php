<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('types', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('nom', 30);
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
		Schema::drop('types');
	}

}