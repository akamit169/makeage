<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('feedbacks', function(Blueprint $table)
		{
			$table->foreign('question_id', 'feedbacks_ibfk_1')->references('id')->on('questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'feedbacks_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('feedbacks', function(Blueprint $table)
		{
			$table->dropForeign('feedbacks_ibfk_1');
			$table->dropForeign('feedbacks_ibfk_2');
		});
	}

}
