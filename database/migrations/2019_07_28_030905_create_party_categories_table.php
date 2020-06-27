<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartyCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('party_category_type_id');
            $table->string('category', 50);
            $table->timestamps();
            $table->foreign('party_category_type_id')->references('id')->on('party_category_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_categories');
    }
}
