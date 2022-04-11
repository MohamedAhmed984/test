<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone')->unique();
			$table->string('password');
			$table->date('birth_date');
			$table->date('last_donation_date');
			$table->bigInteger('city_id')->unsigned();
			$table->bigInteger('blood_type_id')->unsigned();
			$table->string('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}