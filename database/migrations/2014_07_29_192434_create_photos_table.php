<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function($table)
		{
			$table->increments('id');
			$table->string('file_name');
			$table->integer('file_size')->unsigned();
			$table->string('file_mime_type');
			$table->string('file_sha1', 40);
			$table->integer('width')->unsigned();
			$table->integer('height')->unsigned();
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamp('captured_at')->nullable();
			$table->timestamps();

			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photos');
	}

}
