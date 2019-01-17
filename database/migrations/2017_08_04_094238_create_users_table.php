<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('mobile_number', 20)->unique('mobile');
			$table->string('mobile_otp', 10);
			$table->dateTime('otp_expiration_at');
			$table->string('email', 250)->nullable()->index('email');
			$table->string('name', 250)->index('name');
			$table->string('password', 128)->nullable();
			$table->string('avatar_name', 250)->nullable()->index('avatar_name');
			$table->text('avatar_data', 65535)->nullable();
			$table->text('user_bio', 65535)->nullable()->comment('short bio of user');
			$table->string('like', 250)->nullable();
			$table->string('dislike', 250)->nullable();
			$table->boolean('relationship_status')->nullable();
			$table->boolean('gender')->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('country_name', 80)->nullable();
			$table->string('state_name', 100)->nullable();
			$table->float('average_ratting', 2, 1)->nullable();
			$table->boolean('chat_status')->default(1)->comment('0 for unavailable 1 available 2 busy ');
			$table->string('ejabberd_id', 250)->nullable();
			$table->string('ejabberd_password', 250)->nullable();
			$table->boolean('role')->default(1)->index('user_type')->comment('1 for normal user and 2 for admin');
			$table->boolean('status')->index('status');
			$table->boolean('is_verified')->default(0);
			$table->string('remember_token', 120)->nullable();
			$table->softDeletes();
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
		Schema::drop('users');
	}

}
