<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->id();
			$table->string('who_are_we');
			$table->string('facebook_link');
			$table->string('twiter_link');
			$table->string('instgrame_link');
			$table->string('youtube_link');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}