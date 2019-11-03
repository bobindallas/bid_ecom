<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
	 /**
	  * Run the migrations.
	  *
	  * @return void
	  */
	 public function up()
	 {
		  Schema::create('product_categories', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('slug', 254)->default('');
				$table->string('name', 254)->default('');
				$table->text('description')->nullable();
				$table->unsignedInteger('display_order')->default(1);
				$table->unsignedTinyInteger('active')->default(1);
				$table->timestamps();

				$table->unique('slug');
				$table->index('display_order');
		  });
	 }

	 /**
	  * Reverse the migrations.
	  *
	  * @return void
	  */
	 public function down()
	 {
		  Schema::dropIfExists('product_categories');
	 }
}
