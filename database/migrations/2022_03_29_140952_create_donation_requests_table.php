<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('patient_name');
			$table->string('patient_phone');
			$table->string('age');
			$table->bigInteger('bag_blood_number');
			$table->string('hospital_name');
			$table->string('hospital_address');
			$table->decimal('longitude', 10,8);
			$table->decimal('latitude', 10,8);
			$table->longText('hints');
			$table->bigInteger('blood_type_id')->unsigned();
			$table->bigInteger('city_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}