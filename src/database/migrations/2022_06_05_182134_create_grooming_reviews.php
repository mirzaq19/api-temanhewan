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
        Schema::create('grooming_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->text('review');
            $table->boolean('is_public');
            $table->foreignUuid('customer_id');
            $table->foreignUuid('grooming_id');
            $table->foreignUuid('grooming_service_id');
            $table->foreignUuid('grooming_order_id');
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
        Schema::dropIfExists('grooming_reviews');
    }
};
