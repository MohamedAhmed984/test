<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloodTypesTable extends Migration {

	public function up()
	{
		Schema::create('blood_types', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('blood_type_name');
		});
	}

	public function down()
	{
		Schema::drop('blood_types');
	}
}