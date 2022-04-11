<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('title');
			$table->longText('content');
			$table->text('image');
			$table->bigInteger('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}