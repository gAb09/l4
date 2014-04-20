<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableEcritures extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecritures', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->timestamp('date_emission');
			$table->timestamp('date_valeur');
			$table->integer('banque_id')->unsigned();
			$table->integer('type_id')->unsigned();
			$table->string('type_justif', 20)->nullable();
			$table->integer('banque2_id')->unsigned()->nullable();
			$table->string('Libelle', 30)->default('???');
			$table->string('Libelle_detail', 30)->nullable();
			$table->float('montant');
			$table->boolean('signe');
			$table->integer('compte_id')->unsigned()->default('000');
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
		Schema::drop('ecritures');
	}

}
?>