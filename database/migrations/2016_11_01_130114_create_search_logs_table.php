<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('search_logs', function(Blueprint  $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('key_word');
			$table->integer('type');
			$table->dateTime('timestamp');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('search_logs');
	}

}
