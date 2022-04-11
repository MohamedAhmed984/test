<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientGovernmentTable extends Migration {

	public function up()
	{
		Schema::create('client_government', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('client_id')->unsigned();
			$table->bigInteger('government_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_government');
	}
}