<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->string('name');
            $table->integer('credit_days')->default(0);
            $table->float('credit_limit')->default(0);
            $table->unsignedBigInteger('payment_term_id');
            $table->unsignedBigInteger('party_category_id');
            $table->string('building')->nullable();
            $table->string('street')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->string('contact_number', 25)->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('control_account_id')->default(2);
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('payment_term_id')->references('id')->on('payment_terms')->onDelete('cascade');
            $table->foreign('party_category_id')->references('id')->on('party_categories')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debtors');
    }
}
