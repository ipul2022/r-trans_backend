<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            // $table->enum('status', [
            //     'Active',
            //     'Done',
            // ]);
            $table->string('status')->default('Active');
            $table->string('service');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('driver_id');
           // $table->unsignedBigInteger('driver_id');
            // $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
