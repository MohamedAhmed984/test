<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloodTypeClientTable extends Migration {

	public function up()
	{
		Schema::create('blood_type_client', function(Blueprint $table) {
			$table->id();			
			$table->timestamps();
			$table->bigInteger('client_id')->unsigned();
			$table->bigInteger('blood_type_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('blood_type_client');
	}
}