<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_group_id');
            $table->unsignedBigInteger('item_category_id');
            $table->string('name', 120);
            $table->string('bar_code', 50);
            $table->unsignedBigInteger('pack_unit_id');
            $table->unsignedBigInteger('standard_unit_id');
            $table->float('pack_size');
            $table->string('specification')->nullable();
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
        Schema::dropIfExists('items');
    }
}
