<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->id();
			$table->string('phone');
			$table->string('email');
			$table->string('title');
			$table->longText('message');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}