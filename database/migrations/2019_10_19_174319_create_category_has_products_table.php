<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('category_has_products', function (Blueprint $table) {

            $table->bigIncrements('id');
				$table->unsignedBigInteger('product_category_id');
				$table->unsignedBigInteger('product_id');
            $table->timestamps();

				$table->index('product_category_id');
				$table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_has_products');
    }
}
