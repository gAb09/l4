<?php

use Illuminate\Database\Migrations\Migration;

class AllDbAddForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(
			'ecritures', function($table)
			{
				$table->foreign('banque_id')->references('id')->on('banques');
				$table->foreign('type_id')->references('id')->on('types');
				$table->foreign('banque2_id')->references('id')->on('banques');
				$table->foreign('compte_id')->references('id')->on('comptes');
			}
			);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(
			'ecritures', function($table)
			{
				$table->dropIndex('ecritures_banque_id_foreign');
				$table->dropIndex('ecritures_type_id_foreign');
				$table->dropIndex('ecritures_banque2_id_foreign');
				$table->dropIndex('ecritures_compte_id_foreign');
			}
			);
	}

}