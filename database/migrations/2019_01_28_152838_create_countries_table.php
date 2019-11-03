<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('countries', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('code','254');
				$table->string('name','254');
				$table->string('description','254')->nullable();
				$table->unsignedTinyInteger('active')->default(1);
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
		 Schema::dropIfExists('countries');
	}
}
