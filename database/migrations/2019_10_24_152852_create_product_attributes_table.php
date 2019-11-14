<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
	 /**
	  * Run the migrations.
	  *
	  * @return void
	  */
	 public function up() {

		Schema::create('product_attributes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('product_id');
			$table->string('name', 254);
			$table->text('attr_value')->nullable();
			$table->unsignedTinyInteger('display_order')->default(1);
			$table->unsignedTinyInteger('active')->default(1);
			$table->timestamps();

			$table->index('product_id');
			$table->index('display_order');
			$table->index('active');
		});
	 }

	 /**
	  * Reverse the migrations.
	  *
	  * @return void
	  */
	 public function down()
	 {
		  Schema::dropIfExists('product_attributes');
	 }
}
