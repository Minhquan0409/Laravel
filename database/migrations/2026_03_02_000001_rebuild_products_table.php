<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('products');

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->string('name');
            $table->decimal('price', 12, 2);
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_delete')->default(false);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_products_price_non_negative CHECK (price >= 0)');
        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_products_sale_price_non_negative CHECK (sale_price IS NULL OR sale_price >= 0)');
        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_products_sale_price_lte_price CHECK (sale_price IS NULL OR sale_price <= price)');
        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_products_stock_non_negative CHECK (stock >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->unsignedInteger('stock');
            $table->timestamps();
        });
    }
};
