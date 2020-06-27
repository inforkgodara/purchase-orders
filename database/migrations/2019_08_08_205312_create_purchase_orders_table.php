<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('creditor_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('debtor_id')->nullable();
            $table->bigInteger('number')->nullable();
            $table->date('date');
            $table->string('reference')->nullable();
            $table->double('total_quantity', 10, 2)->default(0);
            $table->double('total_amount', 10, 2)->default(0);
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
        Schema::dropIfExists('purchase_orders');
    }
}
