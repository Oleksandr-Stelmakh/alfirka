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

        $table->string('name', 100);
        $table->string('phone', 20);
        $table->string('email');
        $table->text('comment')->nullable();

        $table->string('bouquet_slug');
        $table->string('bouquet_title');

        $table->string('size', 10);

        $table->unsignedInteger('price');

        $table->timestamp('created_at')->useCurrent();
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
