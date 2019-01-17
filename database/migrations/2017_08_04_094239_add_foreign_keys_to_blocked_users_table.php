<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBlockedUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blocked_users', function(Blueprint $table)
		{
			$table->foreign('user_id', 'blocked_users_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('blocked_user_id', 'blocked_users_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blocked_users', function(Blueprint $table)
		{
			$table->dropForeign('blocked_users_ibfk_1');
			$table->dropForeign('blocked_users_ibfk_2');
		});
	}

}
