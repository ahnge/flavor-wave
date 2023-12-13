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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no',255);
            $table->string('region_code');
            $table->foreign('region_code')->references('code')->on('regions');
            $table->string('address',255);
            $table->string('phone_no',255);
            $table->integer('status');
            $table->boolean('is_urgent')->default(false);
            $table->foreignId('distributor_id')->constrained('distributors')->cascadeOnDelete();
            $table->bigInteger('total');
            $table->dateTime('due_date');
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
