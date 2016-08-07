<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->string('name');
            $table->string('handle')->unique()->nullable();
			$table->string('email')->unique()->nullable();
            $table->string('facebook_id')->unique()->nullable();
            $table->integer('twitter_id')->nullable();
            $table->integer('google_id')->nullable();
            $table->string('avatar')->nullable();
			$table->string('password', 60);
            $table->enum('role',['admin','author','subscriber'])->default('author');
			$table->rememberToken();
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
