
<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
Schema::create('users', function($table)
{
    $table->engine = 'InnoDB';

    $table->increments('id');
    $table->string('login', 100)->unique();
    $table->string('mdp', 50);
    $table->string('mail', 50)->unique();
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
    Schema::drop('users');	}

}

?>