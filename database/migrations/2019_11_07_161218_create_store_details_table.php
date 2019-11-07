<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('store_details', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->string('name', 254)->default('');
			$table->string('address1', 254)->nullable()->default('');
			$table->string('address2', 254)->nullable()->default('');
			$table->string('city', 254)->nullable()->default('');
			$table->string('state', 254)->nullable()->default('');
			$table->string('country', 254)->nullable()->default('');
			$table->string('postal_code', 254)->nullable()->default('');
			$table->string('phone1', 254)->nullable()->default('');
			$table->string('phone2', 254)->nullable()->default('');
			$table->string('fax', 254)->nullable()->default('');
			$table->string('email', 254)->nullable()->default('');
			$table->decimal('latitude', 11, 8)->default(0);
			$table->decimal('longitude', 11, 8)->default(0);
			$table->text('description')->nullable();
			$table->unsignedTinyInteger('enable_taxes')->default(1);
			$table->unsignedTinyInteger('enable_shipping')->default(1);
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
		Schema::dropIfExists('store_details');
	}
}
