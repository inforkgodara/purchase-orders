<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('item_group_id')->default(1);
            $table->unsignedBigInteger('item_category_id')->default(1);
            $table->date('effective_from');
            $table->float('purchase_price')->default(0)->nullable();
            $table->float('landed_price')->default(0)->nullable();
            $table->float('selling_price')->default(0)->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('item_prices');
    }
}
