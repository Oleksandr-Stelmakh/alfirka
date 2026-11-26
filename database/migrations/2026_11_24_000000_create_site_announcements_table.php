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
        Schema::create('site_announcements', function (Blueprint $table) {
            $table->id();

            $table->text('message');

            $table->dateTime('starts_at');
            $table->dateTime('ends_at');

            $table->string('theme', 30)->default('burgundy');

            $table->boolean('is_enabled')->default(false);
            $table->boolean('can_be_closed')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_announcements');
    }
};
