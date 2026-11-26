
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('total_price')
                ->default(0)
                ->after('price');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->nullOnDelete();

            $table->foreignId('product_image_id')
                ->nullable()
                ->constrained('product_images')
                ->nullOnDelete();

            // Сохраняем названия и характеристики на момент заказа.
            // Даже если товар впоследствии изменится или будет удалён,
            // информация в старом заказе останется.
            $table->string('product_title');
            $table->string('product_slug');
            $table->string('variant_name', 50);
            $table->string('box_size', 50)->nullable();
            $table->unsignedInteger('flowers_count')->nullable();

            // Путь к выбранной фотографии на момент оформления заказа.
            $table->string('image_path')->nullable();

            $table->unsignedInteger('quantity');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('total_price');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });
    }
};
