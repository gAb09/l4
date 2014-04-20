<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableComptes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comptes', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('numero')->unsigned();
			$table->string('libelle', 20);
			$table->string('description', 500)->nullable();
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
		Schema::drop('comptes');
	}

}