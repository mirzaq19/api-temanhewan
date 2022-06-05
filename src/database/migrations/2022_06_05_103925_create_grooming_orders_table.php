<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grooming_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('address');
            $table->string('status');
            $table->foreignUuid('grooming_service_id');
            $table->foreignUuid('pet_id');
            $table->foreignUuid('customer_id');
            $table->foreignUuid('grooming_id');
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
        Schema::dropIfExists('grooming_orders');
    }
};
