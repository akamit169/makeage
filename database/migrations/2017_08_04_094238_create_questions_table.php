<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('question', 65535)->index('question');
			$table->boolean('type')->comment('1=>avatar,2=>public,3=>friend');
			$table->integer('question_by')->unsigned()->index('question_by')->comment('created by user_id');
			$table->integer('question_for')->unsigned()->nullable()->index('question_for')->comment('created for user_id');
			$table->boolean('status')->index('status');
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
		Schema::drop('questions');
	}

}
