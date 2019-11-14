<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 254)->default('');
            $table->string('name', 254)->default('');
            $table->text('description')->nullable();
            $table->string('sku',254)->nullable()->default('');
            $table->decimal('cost', 10, 2)->default(1);
            $table->decimal('cost_multiplier', 10, 4)->default(1);
            $table->unsignedTinyInteger('active')->default(1);
            $table->timestamps();

            $table->unique('slug');
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
        Schema::dropIfExists('products');
    }
}
