<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableBanques extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banques', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('nom', 20);
			$table->string('description', 50)->nullable();
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
		Schema::drop('banques');
	}

}